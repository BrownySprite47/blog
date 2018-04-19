<?php
echo '<pre>';
//var_dump($data);
    $errors = $data['model']->getErrors();
    if (!empty($errors)){
        var_dump($errors);
    }
?>
<h2>REGISTRATION</h2>
<form method="post">
    <input type="text" name="login" id="login"><br>
    <input type="password" name="password" id="password"><br>
    <input type="password" name="password_confirm" id="password_confirm"><br>
    <input type="submit" id="submit">
</form>
