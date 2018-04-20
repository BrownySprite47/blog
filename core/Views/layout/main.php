<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <script src="/assets/js/jquery-3.3.1.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <title><?= $this->title; ?></title>
    <?php foreach ($this->getCss() as $css): ?>
        <link rel="stylesheet" href="/assets/css/<?= $css ?>">
    <?php endforeach; ?>
    <?php foreach ($this->getJs() as $js): ?>
        <link rel="stylesheet" href="/assets/js/<?= $js ?>">
    <?php endforeach; ?>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand и toggle сгруппированы для лучшего отображения на мобильных дисплеях -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="/assets/images/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
            </a>
        </div>

        <!-- Соберите навигационные ссылки, формы, и другой контент для переключения -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if(!empty($_SESSION['user'])): ?>
                    <li class="active"><a href="/">Главная <span class="sr-only">(current)</span></a></li>
                    <li><a href="/post/myposts">Мои посты</a></li>
                    <li><a href="/post/create">Создать пост</a></li>
                <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(empty($_SESSION['user'])): ?>
                    <li><a href="/main/login">Вход</a></li>
                    <li><a href="/main/register">Регистрация</a></li>
                <?php else: ?>
                    <li><a href="/main/logout">Выход</a></li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <?php include $this->basePath . '/../views/templates/' . $tplName . '.php'; ?>
</div>
</body>
</html>

