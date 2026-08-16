<!-- Floating Theme Switcher Button (Bottom Right) -->
<button type="button" class="theme-switcher-toggle theme-floating-fab" title="Pilih Warna Tema (RGB)" aria-label="Pilih Warna Tema">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/>
        <circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/>
        <circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/>
        <circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/>
        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.92 0 1.7-.71 1.7-1.63 0-.44-.18-.85-.46-1.16-.27-.31-.44-.72-.44-1.21 0-.92.78-1.7 1.7-1.7h2.2c3.04 0 5.5-2.46 5.5-5.5 0-4.97-4.48-8.8-9.7-8.8Z"/>
    </svg>
</button>

<!-- Theme Switcher Popover Modal Component -->
<div class="theme-switcher-modal" id="themeSwitcherModal">
    <div class="theme-modal-header">
        <span class="theme-modal-title">
            🎨 Tema Warna Website
        </span>
        <button type="button" class="theme-modal-close" id="closeThemeModalBtn" aria-label="Tutup Pemilih Tema">&times;</button>
    </div>

    <!-- Preview & HEX Code Input -->
    <div class="theme-preview-section">
        <div class="theme-color-preview-box" id="themeColorPreviewBox" title="Sampel Warna Utama"></div>
        <div class="theme-hex-input-group">
            <span>#</span>
            <input type="text" id="themeHexTextInput" class="theme-hex-text-input" value="23131D" maxlength="7" placeholder="23131D">
        </div>
        <input type="color" id="themeColorPickerInput" class="theme-color-native-input" value="#23131D" title="Pilih Warna Native">
    </div>

    <!-- RGB Rainbow Hue Slider -->
    <div class="theme-slider-container">
        <label class="theme-slider-label">Spektrum Warna RGB (Geser untuk Mengubah)</label>
        <input type="range" id="themeHueRangeInput" class="theme-hue-slider" min="0" max="360" value="322">
    </div>

    <!-- Preset Swatches Grid -->
    <div class="theme-swatches-section">
        <label class="theme-slider-label">Pilihan Warna Cepat</label>
        <div class="theme-swatches-grid">
            <button type="button" class="theme-swatch-btn" data-color="#23131D" style="background-color: #23131D;" title="Dark Plum (Default)"></button>
            <button type="button" class="theme-swatch-btn" data-color="#1B8F5A" style="background-color: #1B8F5A;" title="Hijau Desa"></button>
            <button type="button" class="theme-swatch-btn" data-color="#0057A6" style="background-color: #0057A6;" title="Ocean Blue"></button>
            <button type="button" class="theme-swatch-btn" data-color="#16A34A" style="background-color: #16A34A;" title="Emerald Green"></button>
            <button type="button" class="theme-swatch-btn" data-color="#7C3AED" style="background-color: #7C3AED;" title="Royal Purple"></button>
            <button type="button" class="theme-swatch-btn" data-color="#EA580C" style="background-color: #EA580C;" title="Sunset Orange"></button>
            <button type="button" class="theme-swatch-btn" data-color="#E11D48" style="background-color: #E11D48;" title="Crimson Rose"></button>
        </div>
    </div>

    <!-- Modal Footer -->
    <div class="theme-modal-footer">
        <button type="button" class="theme-reset-btn" id="themeResetBtn">Reset Default</button>
    </div>
</div>
