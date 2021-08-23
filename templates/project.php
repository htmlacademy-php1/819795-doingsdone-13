
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php foreach ($projects  as $key=>$value): ?>
                <li class="main-navigation__list-item <?= $_GET['project_id']==$projectsId [$key]["id"] ? " main-navigation__list-item--active " : '' ?>">
                    <a class="main-navigation__list-item-link" href="http://819795-doingsdone-13/index.php?project_id=<?= $projectsId [$key]["id"]; ?>">
                        <?= htmlspecialchars($value ['content']); ?></a>
                    <span class="main-navigation__list-item-count"><?= countProjects($tasks, $value )  ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="pages/form-project.html" target="project_add">Добавить проект</a>
