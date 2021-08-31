<main class="content__main">
    <h2 class="content__main-heading">Добавление проекта</h2>

    <form class="form"  action="add-project.php" method="post" autocomplete="off">
        <div class="form__row">
            <label class="form__label" for="project_name">Название <sup>*</sup></label>
            <?php $classname = isset($errors) ? "form__input--error" : "" ?>
            <?php $value = $_POST['project_name'] ?? "" ?>
            <input class="form__input <?= $classname ?>" type="text" name="project_name" id="project_name"
                   value="<?= htmlspecialchars($value) ?>" placeholder="Введите название проекта">
            <p class = form__message><?= $errors?? "" ?></p>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    </form>
</main>
