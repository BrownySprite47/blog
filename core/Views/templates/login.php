<h2>LOGIN</h2>
<form method="post">
    <input type="text" name="login" value="<?= (\Library\Request::isPost()) ? $data['model']->login : '' ?>"><br>
    <input type="password" name="password" value="<?= (\Library\Request::isPost()) ? $data['model']->password : '' ?>"><br>
    <input type="submit" id="submit">
</form>
