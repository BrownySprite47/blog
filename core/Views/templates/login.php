<div class="myContainer">
    <h2><?= $this->title; ?></h2>
    <form method="post">
        <input class="fields" type="text" name="login" placeholder="Логин" value="<?= (Core\Library\Request::isPost()) ? $data['model']->login : '' ?>"><br>
        <input class="fields" type="password" name="password" placeholder="Пароль" value="<?= (Core\Library\Request::isPost()) ? $data['model']->password : '' ?>"><br>
        <input class="btn btn-success" type="submit" value="Войти" id="submit">
    </form>
</div>
<?php
$errors = $data['model']->getErrors();
if (!empty($errors)): ?>
    <div class="container-errors">
        <?php foreach ($errors as $field => $error): ?>
            <p class="validErrorForm"><?= $field." : ".$error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>



