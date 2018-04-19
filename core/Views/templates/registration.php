<?php
echo '<pre>';
    $errors = $data['model']->getErrors();
    if (!empty($errors)){
        var_dump($errors);
    }
?>
<h2>REGISTRATION</h2>
<form method="post">
    <input type="text" name="login" value="<?= (\Library\Request::isPost()) ? $data['model']->login : ''?>"><br>
    <input type="password" name="password" value="<?= (\Library\Request::isPost()) ? $data['model']->password : ''?>"><br>
    <input type="password" name="password_confirm" value="<?= (\Library\Request::isPost()) ? $data['model']->password_confirm : ''?>"><br>
    <input type="submit" id="submit">
</form>
