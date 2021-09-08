<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.php" method="post" autocomplete="off">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <?php $projectId = isset($_GET['project_id']) ? htmlspecialchars("&project_id=".$_GET['project_id']) : "" ?>

        <a href="http://819795-doingsdone-13/index.php" class="tasks-switch__item <?= !$_GET['sort']?"tasks-switch__item--active":"" ?>">Все задачи</a>
        <a href="http://819795-doingsdone-13/index.php?sort=1<?= $projectId ?>" class="tasks-switch__item <?= $_GET['sort']==1?"tasks-switch__item--active":"" ?>">Повестка дня</a>
        <a href="http://819795-doingsdone-13/index.php?sort=2<?= $projectId ?>" class="tasks-switch__item <?= $_GET['sort']==2?"tasks-switch__item--active":"" ?>">Завтра</a>
        <a href="http://819795-doingsdone-13/index.php?sort=3<?= $projectId ?>" class="tasks-switch__item <?= $_GET['sort']==3?"tasks-switch__item--active":"" ?>">Просроченные</a>
    </nav>

    <label class="checkbox">
        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
        <input class="checkbox__input visually-hidden show_completed"
            <?= $show_complete_tasks == 1 ? " checked " : '' ?> type="checkbox">
        <span class="checkbox__text">Показывать выполненные</span>
    </label>
</div>

<table class="tasks">
    <tr class="tasks__item task">
        <td class="task__select">
            <label class="checkbox task__checkbox">
                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                <span class="checkbox__text">Сделать главную страницу Дела в порядке</span>
            </label>
        </td>

        <td class="task__file">
            <a class="download-link" href="#">Home.psd</a>
        </td>

        <td class="task__date"></td>
    </tr>

    <?php foreach ($tasks as $key => $value): ?>
        <?php if ($show_complete_tasks == 0 && $value['complete'] == true) {
            continue;
        } ?>
        <tr class="tasks__item <?= $value['complete'] ? " task--completed " : '' ?>
                       <?= checkTime($value['dt_end']) && !$value['complete'] ? " task--important " : '' ?> ">
            <td class="task__select">
                <label class="checkbox task__checkbox ">
                    <input class="checkbox__input visually-hidden" type="checkbox" checked>
                    <span class="checkbox__text"><?= htmlspecialchars($value['content']) ?></span>
                </label>
            </td>
            <td class="task__date"><?= htmlspecialchars($value['dt_end']) ?></td>
            <?php if ($value['url']) : ?>
                <td class="task__file">
                    <a class="download-link"
                       href="C:\Openserver\OSPanel\domains\819795-doingsdone-13\uploads\<?= $value['url'] ?>">
                        <?= htmlspecialchars($value['url']) ?></a>
                </td>
            <?php endif; ?>
            <td class="task__controls"></td>
        </tr>
    <?php endforeach; ?>
</table>
