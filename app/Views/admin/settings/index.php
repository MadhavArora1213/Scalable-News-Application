<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container" style="max-width: 1000px;">
        <header class="content-header">
            <h1><i class="fas fa-cogs"></i> System & Site Configuration</h1>
            <div class="header-actions">
                <button type="button" class="btn btn-primary" onclick="saveSettings()">
                    <i class="fas fa-save"></i> SAVE ALL CONFIG
                </button>
            </div>
        </header>

        <form action="#" method="POST">
            <!-- Branding Section -->
            <div class="admin-panel-box" style="margin-bottom: 30px;">
                <div class="box-header">
                    <h3><i class="fas fa-palette"></i> Branding & Aesthetics</h3>
                </div>
                <div style="padding: 30px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
                        <div class="form-group">
                            <label>Primary Brand Color</label>
                            <div style="display: flex; gap: 15px; align-items: center;">
                                <div style="position: relative; width: 60px; height: 60px; border-radius: 12px; overflow: hidden; border: 1px solid #ddd;">
                                    <input type="color" id="primary-color" name="primary_color" value="#CC2222" 
                                           style="position: absolute; inset: -10px; width: 100px; height: 100px; border: none; cursor: pointer;" 
                                           oninput="updateBrandPreview(this.value)">
                                </div>
                                <input type="text" class="form-control" id="primary-color-text" value="#CC2222" style="font-family: monospace; font-weight: 700; width: 120px;" oninput="updateBrandPreview(this.value)">
                            </div>
                            <p style="font-size: 0.8rem; color: #718096; margin-top: 10px;">Determines the look of buttons, links, and sidebar highlights.</p>
                        </div>
                        <div class="form-group">
                            <label>Accent Secondary Color</label>
                            <div style="display: flex; gap: 15px; align-items: center;">
                                <div style="position: relative; width: 60px; height: 60px; border-radius: 12px; overflow: hidden; border: 1px solid #ddd;">
                                    <input type="color" name="accent_color" value="#E67E22" style="position: absolute; inset: -10px; width: 100px; height: 100px; border: none; cursor: pointer;">
                                </div>
                                <input type="text" class="form-control" value="#E67E22" style="font-family: monospace; font-weight: 700; width: 120px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div class="admin-panel-box" style="margin-bottom: 30px;">
                <div class="box-header">
                    <h3><i class="fas fa-share-alt"></i> Social Media Ecosystem</h3>
                </div>
                <div style="padding: 30px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                        <div class="form-group">
                            <label><i class="fab fa-youtube" style="color: #ff0000;"></i> YouTube Channel</label>
                            <input type="text" class="form-control" value="https://youtube.com/@khabran">
                        </div>
                        <div class="form-group">
                            <label><i class="fab fa-twitter" style="color: #1DA1F2;"></i> Twitter Portfolio</label>
                            <input type="text" class="form-control" value="https://twitter.com/khabran">
                        </div>
                        <div class="form-group">
                            <label><i class="fab fa-instagram" style="color: #E1306C;"></i> Instagram Handle</label>
                            <input type="text" class="form-control" value="https://instagram.com/khabran">
                        </div>
                        <div class="form-group">
                            <label><i class="fab fa-facebook" style="color: #1877F2;"></i> Facebook Community</label>
                            <input type="text" class="form-control" value="https://facebook.com/khabran">
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
                <!-- System settings -->
                <div class="admin-panel-box">
                    <div class="box-header">
                        <h3><i class="fas fa-server"></i> Server Operations</h3>
                    </div>
                    <div style="padding:30px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                            <div>
                                <strong style="display:block;">Maintenance Mode</strong>
                                <small style="color:#718096;">Shut down frontend for visitors.</small>
                            </div>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div>
                                <strong style="display:block;">Debug Mode</strong>
                                <small style="color:#718096;">Show PHP error logs on screen.</small>
                            </div>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="admin-panel-box">
                    <div class="box-header">
                        <h3><i class="fas fa-headset"></i> Support & Contact</h3>
                    </div>
                    <div style="padding: 30px;">
                        <div class="form-group">
                            <label>Official Support Email</label>
                            <input type="email" class="form-control" value="info@khabran.com">
                        </div>
                        <div class="form-group">
                            <label>Hotline Number</label>
                            <input type="text" class="form-control" value="+91 98765-43210">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer & Info -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3><i class="fas fa-info-circle"></i> Footer & Public Info</h3>
                </div>
                <div style="padding: 30px;">
                    <div class="form-group">
                        <label>Site Name (Display)</label>
                        <input type="text" class="form-control" value="ਖ਼ਬਰਾਂ News Portal">
                    </div>
                    <div class="form-group">
                        <label>Footer Description (Punjabi)</label>
                        <textarea class="form-control" style="min-height: 120px;">ਖ਼ਬਰਾਂ ਪੰਜਾਬ ਦਾ ਨੰਬਰ 1 ਨਿਊਜ਼ ਪੋਰਟਲ ਹੈ। ਅਸੀਂ ਤੁਹਾਨੂੰ ਪੰਜਾਬ, ਭਾਰਤ ਅਤੇ ਦੁਨੀਆ ਭਰ ਦੀਆਂ ਤਾਜ਼ਾ ਖ਼ਬਰਾਂ ਪ੍ਰਦਾਨ ਕਰਦੇ ਹਾਂ।</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
/* Switch Toggle Styling */
.switch { position: relative; display: inline-block; width: 46px; height: 24px; }
.switch input { opacity: 0; width: 0; height: 0; }
.slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e0; transition: .4s; border-radius: 24px; }
.slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
input:checked + .slider { background-color: var(--admin-primary); }
input:checked + .slider:before { transform: translateX(22px); }
</style>

<script>
    function updateBrandPreview(color) {
        document.documentElement.style.setProperty('--primary', color);
        document.getElementById('primary-color').value = color;
        document.getElementById('primary-color-text').value = color;
    }

    function saveSettings() {
        const color = document.getElementById('primary-color').value;
        localStorage.setItem('site-primary-color', color);
        alert('Global Settings Saved Successfully!');
    }
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
