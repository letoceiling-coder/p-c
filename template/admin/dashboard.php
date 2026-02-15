<?php if ($this->admin): ?>
<div class="admin-container">
    <div class="admin-sidebar">
        <div class="admin-logo">
            <h2>Админ Панель</h2>
        </div>
        <nav class="admin-menu">
            <ul>
                <li><a href="/admin" class="<?= ($this->urlArray[0] == 'admin' && !isset($this->urlArray[1])) ? 'active' : '' ?>">
                    <i class="fa fa-dashboard"></i> Главная
                </a></li>
                <li><a href="/admin/telegram" class="<?= (isset($this->urlArray[1]) && $this->urlArray[1] == 'telegram') ? 'active' : '' ?>">
                    <i class="fa fa-telegram"></i> Telegram Бот
                </a></li>
                <li><a href="/admin/settings" class="<?= (isset($this->urlArray[1]) && $this->urlArray[1] == 'settings') ? 'active' : '' ?>">
                    <i class="fa fa-cog"></i> Настройки
                </a></li>
                <li><a href="/admin/logout">
                    <i class="fa fa-sign-out"></i> Выход
                </a></li>
            </ul>
        </nav>
    </div>
    <div class="admin-content">
        <div class="admin-header">
            <h1>Главная панель</h1>
            <div class="admin-user">
                <span>Добро пожаловать, <?= htmlspecialchars($this->admin['login'] ?? 'Администратор') ?></span>
            </div>
        </div>
        <div class="admin-main">
            <div class="admin-cards">
                <div class="admin-card">
                    <div class="card-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="card-content">
                        <h3>Пользователи</h3>
                        <p>Управление пользователями системы</p>
                    </div>
                </div>
                <div class="admin-card">
                    <div class="card-icon">
                        <i class="fa fa-telegram"></i>
                    </div>
                    <div class="card-content">
                        <h3>Telegram Бот</h3>
                        <p>Настройка и управление ботом</p>
                    </div>
                </div>
                <div class="admin-card">
                    <div class="card-icon">
                        <i class="fa fa-cog"></i>
                    </div>
                    <div class="card-content">
                        <h3>Настройки</h3>
                        <p>Общие настройки системы</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <?php include 'authorization.php'; ?>
<?php endif; ?>
