<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php $sort = isset($_GET['sort']) ? "&sort=".$_GET['sort'] : "" ?>
            <?php foreach ($projects  as $key=>$value): ?>
                <li class="main-navigation__list-item <?= $_GET['project_id']==$value["id"] ? " main-navigation__list-item--active " : '' ?>">
                    <a class="main-navigation__list-item-link" href="http://819795-doingsdone-13/index.php?project_id=<?= $value["id"] . $sort; ?>">
                        <?= htmlspecialchars($value ['content']); ?></a>
                    <span class="main-navigation__list-item-count"><?= countProjects($tasks, $value )  ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="add-project.php" target="project_add">Добавить проект</a>
</section>

