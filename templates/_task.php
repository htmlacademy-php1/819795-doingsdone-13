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

<?php foreach ($tasks as $key=>$value): ?>
<?php if ($show_complete_tasks==0 && $value['made']==true) {continue;} ?>
<tr class="tasks__item <?= $value['made'] ?  " task--completed " : ''?>
                       <?= checkTime($value['date']) ? " task--important " : ''  ?> ">
    <td class="task__select">
        <label class="checkbox task__checkbox ">
            <input class="checkbox__input visually-hidden" type="checkbox"  checked >
            <span class="checkbox__text"><?= htmlspecialchars($value['task'])?></span>
        </label>
    </td>
    <td class="task__date"><?= htmlspecialchars($value['date'])?></td>

    <td class="task__controls">
    </td>
</tr>
<?php endforeach; ?>
