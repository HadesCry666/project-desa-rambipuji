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
            <input type="text" id="themeHexTextInput" class="theme-hex-text-input" value="0057A6" maxlength="7" placeholder="0057A6">
        </div>
        <input type="color" id="themeColorPickerInput" class="theme-color-native-input" value="#0057A6" title="Pilih Warna Native">
    </div>

    <!-- RGB Rainbow Hue Slider -->
    <div class="theme-slider-container">
        <label class="theme-slider-label">Spektrum Warna RGB (Geser untuk Mengubah)</label>
        <input type="range" id="themeHueRangeInput" class="theme-hue-slider" min="0" max="360" value="210">
    </div>

    <!-- Preset Swatches Grid -->
    <div class="theme-swatches-section">
        <label class="theme-slider-label">Pilihan Warna Cepat</label>
        <div class="theme-swatches-grid">
            <button type="button" class="theme-swatch-btn" data-color="#0057A6" style="background-color: #0057A6;" title="Ocean Blue (Admin Default)"></button>
            <button type="button" class="theme-swatch-btn" data-color="#16A34A" style="background-color: #16A34A;" title="Emerald Green (Smart Village)"></button>
            <button type="button" class="theme-swatch-btn" data-color="#7C3AED" style="background-color: #7C3AED;" title="Royal Purple"></button>
            <button type="button" class="theme-swatch-btn" data-color="#EA580C" style="background-color: #EA580C;" title="Sunset Orange"></button>
            <button type="button" class="theme-swatch-btn" data-color="#E11D48" style="background-color: #E11D48;" title="Crimson Rose"></button>
            <button type="button" class="theme-swatch-btn" data-color="#0D9488" style="background-color: #0D9488;" title="Teal Cyan"></button>
        </div>
    </div>

    <!-- Modal Footer -->
    <div class="theme-modal-footer">
        <button type="button" class="theme-reset-btn" id="themeResetBtn">Reset Default</button>
    </div>
</div>
