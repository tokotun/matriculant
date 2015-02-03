<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Простой сайт</title>
    <link rel="stylesheet"  href="bootstrap/css/bootstrap.css" media="screen">
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <li <?php if ($_SERVER['PHP_SELF'] == '/matriculant/index.php'):?>
                        class="active" 
                    <?php endif;?>>
                    <a href="index.php">На главную</a>
                </li>
                <li <?php if ($_SERVER['PHP_SELF'] == '/matriculant/login.php'):?>
                        class="active" 
                    <?php endif;?>>
                    <a href="login.php">
                        <?php if ($template->checkloggedIn()):?>
                            Редактировать профиль
                        <?php else :?>
                            Зарегистрироватся
                        <?php endif;?>
                    </a>
                </li>
            </ul>
            <?php if ($_SERVER['PHP_SELF'] == '/matriculant/index.php'):?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="form-search navbar-form pull-right">
                    <input type="text" name="userSearch" class="input-medium search-query">
                    <button type="submit" class="btn">Search</button>
                </form>
            <?php endif;?>     
        </div>
    </div>
</div>