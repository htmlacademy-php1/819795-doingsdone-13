<header class="main-header">
    <a href="index.php">
        <img src="../img/logo.png" width="153" height="42" alt="Логитип Дела в порядке">
    </a>

    <div class="main-header__side">
        <a class="main-header__side-item button button--plus" href="add.php">Добавить задачу</a>

        <div class="main-header__side-item user-menu">
            <div class="user-menu__data">
                <p><?= $userName  ?></p>

                <a href="logout.php">Выйти</a>
            </div>
        </div>
    </div>
</header>
