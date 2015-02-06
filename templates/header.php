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
                <li <?php if ($section == 'index'):?>
                        class="active" 
                    <?php endif;?>>
                    <a href="index.php">На главную</a>
                </li>
                <li <?php if ($section == 'login'):?>
                        class="active" 
                    <?php endif;?>>
                    <a href="login.php">
                        <?php if ($loggedIn):?>
                            Редактировать профиль
                        <?php else :?>
                            Зарегистрироватся
                        <?php endif;?>
                    </a>
                </li>
            </ul>
            <?php if ($section == 'index'):?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="form-search navbar-form pull-right">
                    <input type="text" name="userSearch" class="input-medium search-query">
                    <button type="submit" class="btn">Search</button>
                </form>
            <?php endif;?>     
        </div>
    </div>
</div>