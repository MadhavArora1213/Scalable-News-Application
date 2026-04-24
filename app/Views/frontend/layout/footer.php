<?php $tr = Core\LanguageHelper::getTranslations($lang); ?>
    
    <!-- Newsletter Section (Blueprint 4.1) -->
    <section class="newsletter-capture">
        <div class="nav-container newsletter-box">
            <div class="newsletter-text">
                <h3><?= $lang == 'pa' ? 'ਸਾਡੇ ਨਾਲ ਜੁੜੋ' : ($lang == 'hi' ? 'हमारे साथ जुड़ें' : 'Stay Connected') ?></h3>
                <p><?= $lang == 'pa' ? 'ਤਾਜ਼ਾ ਖ਼ਬਰਾਂ ਸਿੱਧਾ ਆਪਣੇ ਇਨਬਾਕਸ ਵਿੱਚ ਪ੍ਰਾਪਤ ਕਰੋ' : ($lang == 'hi' ? 'ताज़ा खबरें सीधे अपने इनबॉक्स में प्राप्त करें' : 'Get the latest news directly in your inbox') ?></p>
            </div>
            <form action="<?= SITE_URL ?>/subscribe" method="POST" class="newsletter-form">
                <input type="email" name="email" placeholder="email@example.com" required>
                <button type="submit"><?= $lang == 'pa' ? 'ਸਬਸਕ੍ਰਾਈਬ' : ($lang == 'hi' ? 'सब्सक्राइब' : 'SUBSCRIBE') ?></button>
            </form>
        </div>
    </section>

    <!-- Detailed Footer (Blueprint 4.1) -->
    <footer class="main-footer">
        <div class="nav-container footer-grid">
            <div class="footer-col">
                <h2 class="footer-logo">ਖ਼ਬਰਾਂ KHABRAN</h2>
                <p>Leading trilingual news portal from Punjab, committed to independent journalism, ground reports, and depth analysis of politics and economy.</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-telegram"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Network</h4>
                <ul class="footer-links">
                    <li><a href="<?= SITE_URL ?>/pa">ਪੰਜਾਬੀ (Punjabi)</a></li>
                    <li><a href="<?= SITE_URL ?>/hi">हिन्दी (Hindi)</a></li>
                    <li><a href="<?= SITE_URL ?>/en">English News</a></li>
                    <li><a href="#">Khabran TV</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <ul class="footer-links">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Code of Ethics</a></li>
                    <li><a href="#">RNI Registration</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <ul class="footer-links">
                    <li>Email: contact@khabran.com</li>
                    <li>WhatsApp: +91 98XXX-XXXXX</li>
                    <li>Ludhiana, Punjab, India</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="nav-container">
                <p>&copy; <?= date('Y') ?> Khabran News Portal. Registration No: PB-2026-X. Built for Excellence.</p>
            </div>
        </div>
    </footer>

    <script>
        // Live Clock Implementation
        const clock = document.getElementById('live-clock');
        const updateClock = () => {
            if(clock) {
                const now = new Date();
                clock.textContent = now.toLocaleTimeString('en-US', { hour12: false });
            }
        };
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>
