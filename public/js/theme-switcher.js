/**
 * Desa Rambipuji - Smart Village Theme Switcher Engine (2026)
 * Supports custom RGB Spectrum/Hue Slider, HEX input, Preset Swatches, and LocalStorage persistence.
 */

(function () {
    const STORAGE_KEY = 'desa_rambipuji_theme_color';
    const DEFAULT_PRIMARY = '#23131D'; // Dark Plum Default

    // Convert HEX to HSL object {h, s, l}
    function hexToHSL(hex) {
        hex = hex.replace(/^#/, '');
        if (hex.length === 3) {
            hex = hex.split('').map(c => c + c).join('');
        }
        let r = parseInt(hex.substring(0, 2), 16) / 255;
        let g = parseInt(hex.substring(2, 4), 16) / 255;
        let b = parseInt(hex.substring(4, 6), 16) / 255;

        let max = Math.max(r, g, b), min = Math.min(r, g, b);
        let h, s, l = (max + min) / 2;

        if (max === min) {
            h = s = 0; // achromatic
        } else {
            let d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            switch (max) {
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }
            h /= 6;
        }

        return {
            h: Math.round(h * 360),
            s: Math.round(s * 100),
            l: Math.round(l * 100)
        };
    }

    // Convert HSL to HEX string
    function hslToHex(h, s, l) {
        s /= 100;
        l /= 100;
        let c = (1 - Math.abs(2 * l - 1)) * s;
        let x = c * (1 - Math.abs((h / 60) % 2 - 1));
        let m = l - c / 2;
        let r = 0, g = 0, b = 0;

        if (0 <= h && h < 60) { r = c; g = x; b = 0; }
        else if (60 <= h && h < 120) { r = x; g = c; b = 0; }
        else if (120 <= h && h < 180) { r = 0; g = c; b = x; }
        else if (180 <= h && h < 240) { r = 0; g = x; b = c; }
        else if (240 <= h && h < 300) { r = x; g = 0; b = c; }
        else if (300 <= h && h < 360) { r = c; g = 0; b = x; }

        r = Math.round((r + m) * 255).toString(16).padStart(2, '0');
        g = Math.round((g + m) * 255).toString(16).padStart(2, '0');
        b = Math.round((b + m) * 255).toString(16).padStart(2, '0');

        return `#${r}${g}${b}`;
    }

    // Convert HEX to RGB object {r, g, b}
    function hexToRGB(hex) {
        hex = hex.replace(/^#/, '');
        if (hex.length === 3) hex = hex.split('').map(c => c + c).join('');
        return {
            r: parseInt(hex.substring(0, 2), 16),
            g: parseInt(hex.substring(2, 4), 16),
            b: parseInt(hex.substring(4, 6), 16)
        };
    }

    // Apply primary color to document :root variables
    window.applyThemeColor = function (primaryHex, save = true) {
        if (!primaryHex || !/^#[0-9A-Fa-f]{6}$/.test(primaryHex)) return;

        const hsl = hexToHSL(primaryHex);
        const rgb = hexToRGB(primaryHex);

        // Hover variant (darker)
        const hoverL = Math.max(10, hsl.l - 12);
        const primaryHoverHex = hslToHex(hsl.h, hsl.s, hoverL);

        // Light background tint variant (very soft)
        const primaryLightHex = hslToHex(hsl.h, Math.min(hsl.s, 80), 96);
        const primaryLightRgba = `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, 0.08)`;
        const primaryBorderRgba = `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, 0.25)`;

        // Secondary gradient hue (shift hue by 15 deg)
        const gradHue = (hsl.h + 15) % 360;
        const gradHex = hslToHex(gradHue, hsl.s, Math.max(15, hsl.l - 8));

        const root = document.documentElement;

        // Set global CSS Custom Properties
        root.style.setProperty('--primary', primaryHex);
        root.style.setProperty('--primary-hover', primaryHoverHex);
        root.style.setProperty('--primary-light', primaryLightHex);
        root.style.setProperty('--primary-light-rgba', primaryLightRgba);
        root.style.setProperty('--primary-border-rgba', primaryBorderRgba);
        root.style.setProperty('--grad-primary', `linear-gradient(135deg, ${primaryHex} 0%, ${gradHex} 100%)`);
        root.style.setProperty('--shadow-glow-theme', `0 8px 24px rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, 0.3)`);

        // Compatibility variables for landing page
        root.style.setProperty('--primary-green', primaryHex);
        root.style.setProperty('--primary-green-hover', primaryHoverHex);
        root.style.setProperty('--primary-green-light', primaryLightHex);
        root.style.setProperty('--primary-blue', primaryHex);

        if (save) {
            localStorage.setItem(STORAGE_KEY, primaryHex);
        }

        // Update UI controls if Modal is present
        updateModalInputs(primaryHex, hsl.h);
    };

    function updateModalInputs(hex, hue) {
        const colorInput = document.getElementById('themeColorPickerInput');
        const hexTextInput = document.getElementById('themeHexTextInput');
        const hueRangeInput = document.getElementById('themeHueRangeInput');
        const colorPreview = document.getElementById('themeColorPreviewBox');

        if (colorInput) colorInput.value = hex;
        if (hexTextInput) hexTextInput.value = hex.toUpperCase();
        if (hueRangeInput && typeof hue === 'number') hueRangeInput.value = hue;
        if (colorPreview) colorPreview.style.backgroundColor = hex;
    }

    // Immediately load saved theme before DOM fully renders to prevent flash of wrong color
    const savedColor = localStorage.getItem(STORAGE_KEY);
    if (savedColor) {
        window.applyThemeColor(savedColor, false);
    }

    // DOM Ready setup for Modal/Popover interactions
    document.addEventListener('DOMContentLoaded', function () {
        const activeColor = localStorage.getItem(STORAGE_KEY) || DEFAULT_PRIMARY;
        window.applyThemeColor(activeColor, false);

        // Bind Hue Slider
        const hueSlider = document.getElementById('themeHueRangeInput');
        if (hueSlider) {
            hueSlider.addEventListener('input', function (e) {
                const hueVal = parseInt(e.target.value, 10);
                // Keep saturation 85%, lightness 45% for rich vibrant theme colors
                const newHex = hslToHex(hueVal, 85, 45);
                window.applyThemeColor(newHex, true);
            });
        }

        // Bind Native Color Picker Input
        const colorPickerInput = document.getElementById('themeColorPickerInput');
        if (colorPickerInput) {
            colorPickerInput.addEventListener('input', function (e) {
                window.applyThemeColor(e.target.value, true);
            });
        }

        // Bind HEX Text Input
        const hexTextInput = document.getElementById('themeHexTextInput');
        if (hexTextInput) {
            hexTextInput.addEventListener('change', function (e) {
                let val = e.target.value.trim();
                if (!val.startsWith('#')) val = '#' + val;
                if (/^#[0-9A-Fa-f]{6}$/.test(val)) {
                    window.applyThemeColor(val, true);
                }
            });
        }

        // Bind Preset Swatch Buttons
        const swatchBtns = document.querySelectorAll('.theme-swatch-btn');
        swatchBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const color = this.getAttribute('data-color');
                if (color) {
                    window.applyThemeColor(color, true);
                }
            });
        });

        // Bind Reset Button
        const resetBtn = document.getElementById('themeResetBtn');
        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                window.applyThemeColor(DEFAULT_PRIMARY, true);
            });
        }

        // Modal Open / Toggle Handlers
        const toggleBtns = document.querySelectorAll('.theme-switcher-toggle');
        toggleBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const modal = document.getElementById('themeSwitcherModal');
                if (modal) {
                    modal.classList.toggle('active');
                }
            });
        });

        // Close Modal when clicking Close Button or Outside
        const closeBtn = document.getElementById('closeThemeModalBtn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                const modal = document.getElementById('themeSwitcherModal');
                if (modal) modal.classList.remove('active');
            });
        }

        document.addEventListener('click', function (e) {
            const modal = document.getElementById('themeSwitcherModal');
            if (modal && modal.classList.contains('active')) {
                if (!modal.contains(e.target) && !e.target.closest('.theme-switcher-toggle')) {
                    modal.classList.remove('active');
                }
            }
        });
    });
})();
