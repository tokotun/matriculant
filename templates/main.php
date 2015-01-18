<?php include('templates/header.php'); ?>

<h1>Главная страница</h1>
<a href="login.php">Войти/редактировать данные</a>
<table class='table'>
    <thead>
        <tr>
        <!-- тут выводятся заголовки колонок           -->
            <?php foreach ($columns as $key => $value): ?>
                <th><a href='<?= h($pager->getSortLink($key)); ?>'><?= $pager->getArrow($key); ?><?=$value ?></a></th>
            <?php endforeach  ?>
        </tr>
    </thead>

<!-- тут выводятся таблица внешний цикл выводит по строчно          -->
    <?php foreach ($listMatriculant as $key => $value): ?>
        <tr class="success">
        <!-- внутренний цикл по ячейке.    -->
            <?php foreach ($columns as $keyColumn => $valueColumn): ?>
                <td><?= h($listMatriculant[$key][$keyColumn]); ?></td>
            <?php endforeach  ?>
        </tr>
    <?php endforeach  ?>
</table>



<!-- формируем вот такую стрелку "<<"           -->
    <?php if ($pager->curentPage == 1): ?>
        &lt;&lt;
    <?php else: ?>
        <a href="<?= $pager->getPreviousPage() ?>">&lt;&lt;</a>
    <?php endif; ?>

<!-- формируем циферки со ссылками на странички           -->
    <?php foreach ($pager->getLinks() as $text => $link): ?>
        <?php if ($pager->curentPage == $text): ?>
            <?= $text; ?>
        <?php else: ?>
            <a href="<?= h($link); ?>"><?= $text; ?></a>
        <?php endif; ?>
    <?php endforeach ?>

<!-- формируем вот такую стрелку ">>"           -->
    <?php if ($pager->curentPage == $pager->countPage): ?>
        &gt;&gt;
    <?php else: ?>
        <a href="<?= $pager->getNextPage() ?>">&gt;&gt;</a>
    <?php endif; ?>
    
<?php include('templates/footer.php'); ?>

