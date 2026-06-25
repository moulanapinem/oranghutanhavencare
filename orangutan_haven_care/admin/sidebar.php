<div class="sidebar">
    <div class="sidebar-logo">
        <span class="logo-icon">🦧</span>
        <span>OHC Admin</span>
    </div>
    <ul>
        <li><a href="dashboard.php" <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'class="active"' : ''; ?>>
            <span class="nav-icon">📊</span> Dashboard
        </a></li>
        <li><a href="data_orangutan.php" <?= basename($_SERVER['PHP_SELF']) == 'data_orangutan.php' ? 'class="active"' : ''; ?>>
            <span class="nav-icon">🦧</span> Data Orangutan
        </a></li>
        <li><a href="data_donasi.php" <?= basename($_SERVER['PHP_SELF']) == 'data_donasi.php' ? 'class="active"' : ''; ?>>
            <span class="nav-icon">💚</span> Data Donasi
        </a></li>
        <li class="sidebar-divider"></li>
        <li><a href="logout.php" class="nav-logout">
            <span class="nav-icon">🚪</span> Logout
        </a></li>
    </ul>
</div>
 