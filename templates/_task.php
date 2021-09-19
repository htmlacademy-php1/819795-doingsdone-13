<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.php" method="get" autocomplete="off">
    <?php $searchValue = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : "" ?>
    <input class="search-form__input " type="text" name="search" value="<?= $searchValue ?>"
           placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="">

</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <?php $projectId = isset($_GET['project_id']) ? "&project_id=" . htmlspecialchars($_GET['project_id']) : "" ?>
        <?php $sort = $_GET['sort'] ?? "" ?>
        <a href="http://819795-doingsdone-13/index.php"
           class="tasks-switch__item <?= !$sort ? "tasks-switch__item--active" : "" ?>">Все задачи</a>
        <a href="http://819795-doingsdone-13/index.php?sort=1<?= $projectId ?>"
           class="tasks-switch__item <?= $sort == 1 ? "tasks-switch__item--active" : "" ?>">Повестка дня</a>
        <a href="http://819795-doingsdone-13/index.php?sort=2<?= $projectId ?>"
           class="tasks-switch__item <?= $sort == 2 ? "tasks-switch__item--active" : "" ?>">Завтра</a>
        <a href="http://819795-doingsdone-13/index.php?sort=3<?= $projectId ?>"
           class="tasks-switch__item <?= $sort == 3 ? "tasks-switch__item--active" : "" ?>">Просроченные</a>
    </nav>

    <label class="checkbox">
        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
        <input class="checkbox__input visually-hidden show_completed"
            <?= $show_complete_tasks ? " checked " : '' ?> type="checkbox">
        <span class="checkbox__text">Показывать выполненные</span>
    </label>
</div>
<?php $search = empty($tasks) && isset($_GET['search']) ? "Ничего не найдено по вашему запросу" : "" ?>
<p><?= $search ?></p>
<table class="tasks">
    <?php foreach ($tasks as $key => $value): ?>
        <?php if (!$show_complete_tasks && $value['complete'] == true) {
            continue;
        } ?>
        <tr class="tasks__item task<?= $value['complete'] ? " task--completed " : '' ?>
                       <?= checkTime($value['dt_end']) && !$value['complete'] ? " task--important " : '' ?> ">
            <td class="task__select">
                <label class="checkbox task__checkbox ">
                    <?php $checked = $value['complete'] ? " checked " : '' ?>
                    <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                           value="<?= $value['id'] ?>" <?= $checked ?>>
                    <span class="checkbox__text"><?= htmlspecialchars($value['content']) ?></span>
                </label>
            </td>
            <td class="task__file">
                <?php if ($value['url']) : ?>
                    <a class="download-link"
                       href="..\uploads\<?= $value['url'] ?>">
                        <?= htmlspecialchars($value['url']) ?></a>
                <?php endif; ?>
            </td>
            <?php if ($value['dt_end']) {
                $date = new DateTime($value['dt_end']);
                $date = $date->format('d.m.Y');
            } else {
                $date = 'Нет';
            } ?>
            <td class="task__date"><?= $date ?></td>
            <td class="task__controls"></td>
        </tr>
    <?php endforeach; ?>
</table>
