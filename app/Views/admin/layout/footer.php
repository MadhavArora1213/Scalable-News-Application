<?php if(!isset($hide_sidebar)): ?>
        </main>
    </div>
    <?php endif; ?>

    <script>
        function toggleTheme() {
            const body = document.body;
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            body.setAttribute('data-theme', newTheme);
            
            const icon = document.querySelector('#theme-toggle i');
            icon.className = newTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
            
            localStorage.setItem('admin-theme', newTheme);
        }

        // Initialize theme and color
        const savedTheme = localStorage.getItem('admin-theme') || 'light';
        const savedColor = localStorage.getItem('site-primary-color') || '#CC2222';
        
        document.body.setAttribute('data-theme', savedTheme);
        document.documentElement.style.setProperty('--primary', savedColor);
        
        const icon = document.querySelector('#theme-toggle i');
        if (icon) {
            icon.className = savedTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
        }
    </script>
</body>
</html>
