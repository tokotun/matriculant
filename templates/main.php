<?php include('templates/header.php'); ?>

<h1>Главная страница</h1>
<a href="login.php">Войти/редактировать данные</a>
<table class='table'>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Number Group</th>
            <th>Score</th>
        </tr>
    </thead>
    <?php 
        viewTableMatriculant($listMatriculant); //'<br>Тут будет выведен список студентов из БД';
    ?>
</table>
    <?= $page_links?>

</body>
</html>

