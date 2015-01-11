<?php include('templates/header.php'); ?>

<h1>Главная страница</h1>
<a href="login.php">Войти/редактировать данные</a>
<table class='table'>
    <thead>
        <tr>
            <?= $sort_links?>
        </tr>
    </thead>
    <?php 
        viewTableMatriculant($listMatriculant); //'<br>Тут будет выведен список студентов из БД';
    ?>
</table>
    <?= $page_links?>

</body>
</html>

