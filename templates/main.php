<?php include('templates/header.php'); ?>

<h1>Главная страница</h1>
<a href="login.php">Войти/редактировать данные</a>
<table class='table'>
    <thead>
        <tr>
            <?= $sort_links?>
        </tr>
    </thead>
    <?php foreach ($listMatriculant as $key => $value): ?>
    	<tr class="success">
		    <td><?= htmlspecialchars($listMatriculant[$key]['name']); ?></td>
		    <td><?= htmlspecialchars($listMatriculant[$key]['surname']); ?></td>
		    <td><?= htmlspecialchars($listMatriculant[$key]['numberGroup']); ?></td>
		    <td><?= htmlspecialchars($listMatriculant[$key]['score']); ?></td>
		</tr>
    <?php endforeach  ?>
</table>
    <?= $page_links?>

</body>
</html>

