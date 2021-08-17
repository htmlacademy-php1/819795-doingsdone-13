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
<?php if ($show_complete_tasks==0 && $value['complete']==true) {continue;} ?>
<tr class="tasks__item <?= $value['complete'] ?  " task--completed " : ''?>
                       <?= checkTime($value['dt_end'])&&!$value['complete'] ? " task--important " : ''  ?> ">
    <td class="task__select">
        <label class="checkbox task__checkbox ">
            <input class="checkbox__input visually-hidden" type="checkbox"  checked >
            <span class="checkbox__text"><?= htmlspecialchars($value['content'])?></span>
        </label>
    </td>
    <td class="task__date"><?= htmlspecialchars($value['dt_end'])?></td>

    <td class="task__controls">
    </td>
</tr>
<?php endforeach; ?>
