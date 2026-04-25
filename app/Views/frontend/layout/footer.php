<?php $tr = Core\LanguageHelper::getTranslations($lang); ?>
    
    <footer class="footer">
        <div class="section-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <span class="footer-logo"><?= $lang == 'pa' ? 'ਖ਼ਬਰਾਂ' : ($lang == 'hi' ? 'ख़बरें' : 'Khabran') ?></span>
                    <p>Independent, authoritative, and committed to reporting the truth. Khabran is Punjab's leading trilingual news platform.</p>
                    <div style="margin-top: 25px; display: flex; gap: 20px; font-size: 1.5rem;">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Sections</h4>
                    <ul class="footer-links">
                        <li><a href="#">Politics</a></li>
                        <li><a href="#">Economy</a></li>
                        <li><a href="#">Ground Reports</a></li>
                        <li><a href="#">Opinion</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Ethics Code</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul class="footer-links">
                        <li>Email: editor@khabran.com</li>
                        <li>Phone: +91 98XXX XXXXX</li>
                        <li>Address: Ludhiana, Punjab</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> Khabran News Media. All rights reserved. Registered with RNI.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth Scroll or other JS can go here
        document.getElementById('search-toggle')?.addEventListener('click', (e) => {
            e.preventDefault();
            // Implement search overlay if needed
        });
    </script>
</body>
</html>
