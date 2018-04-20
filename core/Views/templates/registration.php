<div class="myContainer">
    <h2><?= $this->title; ?></h2>
    <form method="post">
        <input class="fields" type="text" name="login" placeholder="Логин" value="<?= (Core\Library\Request::isPost()) ? $data['model']->login : ''?>"><br>
        <input class="fields" type="password" placeholder="Пароль" name="password" value="<?= (Core\Library\Request::isPost()) ? $data['model']->password : ''?>"><br>
        <input class="fields" type="password" placeholder="Повторите пароль" name="password_confirm" value="<?= (Core\Library\Request::isPost()) ? $data['model']->password_confirm : ''?>"><br>
        <input class="btn btn-success" type="submit" value="Зарегистрироваться" id="submit">
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
