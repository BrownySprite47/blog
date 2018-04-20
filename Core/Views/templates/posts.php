<div class="postsContainer">
    <h1><?= $this->title; ?></h1>

    <?php
   // echo '<pre>';
    //var_dump($data);
    ?>
    <br><br>
    <?php foreach ($data['model']->posts as $post): ?>
        <a href="/post/view/<?= $post['id'] ?>" class="linkPost">
        <div>
            <h3>Пост № <?= $post['id'] ?></h3>
            <p><strong>Заголовок: </strong><?= $post['title'] ?></p>
            <p><strong>Описание: </strong><?= $post['content'] ?></p>
            <p><strong>Автор: </strong><?= $post['author_name'] ?></p>
            <p><strong>Время создания: </strong><?= $post['pubdate'] ?></p>
            <?php if(\Core\Library\Auth::getUserId() == $post['author_id']): ?>
                <a class="btn btn-success" href="/post/edit/<?= $post['id'] ?>">Edit</a>
                <a class="btn btn-danger" href="/post/delete/<?= $post['id'] ?>">Delete</a>
            <?php endif; ?>
        </div>
        </a><br><br>
    <?php endforeach; ?>
</div>