<aside class="sidebar">
    <a href="/news/Scalable-News-Application/admin/dashboard" class="sidebar-logo">
        <i class="fas fa-newspaper"></i>
        <span>ਖ਼ਬਰਾਂ Admin</span>
    </a>

    <nav>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/dashboard" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/articles" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'articles') ? 'active' : '' ?>">
                    <i class="fas fa-file-alt"></i>
                    <span>Articles</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/media" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'media') ? 'active' : '' ?>">
                    <i class="fas fa-images"></i>
                    <span>Media Library</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/categories" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'categories') ? 'active' : '' ?>">
                    <i class="fas fa-th-large"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/comments" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'comments') ? 'active' : '' ?>">
                    <i class="fas fa-comments"></i>
                    <span>Comments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/breaking" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'breaking') ? 'active' : '' ?>">
                    <i class="fas fa-bolt"></i>
                    <span>Breaking News</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/analytics" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'analytics') ? 'active' : '' ?>">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
                </a>
            </li>
            <li class="nav-item">
                <hr style="margin: 16px 0; border: none; border-top: 1px solid var(--border-color);">
            </li>
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/users" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'users') ? 'active' : '' ?>">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/settings" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'settings') ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/Scalable-News-Application/admin/logout" class="nav-link" style="color: #ef4444;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
