<?php
//echo '<pre>';
//var_dump($data);
?>
<div class="myContainer post_form">
    <?php if(!empty($data['model']->id)): ?>
        <h2><?= $this->title; ?> № <?= $data['model']->id ?></h2>
    <?php else: ?>
        <h2><?= $this->title; ?></h2>
    <?php endif; ?>
    <br><br>
    <form method="post">
        <input class="fields post_form_input" type="text" name="title" placeholder="Заголовок" value="<?= (!empty($data['model']->title)) ? $data['model']->title : '' ?>"><br>
        <textarea style="resize: none" class="fields post_form_input" rows="10" type="password" name="content" placeholder="Описание"><?= (!empty($data['model']->content)) ? $data['model']->content : '' ?></textarea><br>
        <input class="btn btn-success" type="submit" value="Отправить" id="submit">
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