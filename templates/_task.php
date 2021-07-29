<tr class="tasks__item task <?= $value['made'] ?  " task--completed " : '' ?>">
    <td class="task__select">
        <label class="checkbox task__checkbox">
            <input class="checkbox__input visually-hidden" type="checkbox"  checked >
            <span class="checkbox__text"><?= htmlspecialchars($value['task'])?></span>
        </label>
    </td>
    <td class="task__date"><?= htmlspecialchars($value['date'])?></td>

    <td class="task__controls">
    </td>
</tr>
