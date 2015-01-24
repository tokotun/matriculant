<?php include('templates/header.php'); ?>

<div class="navbar"><div class="navbar-inner"><div class="container">
<ul class="nav">
    <li class="active"><a href="#">На главную</a></li>
        <li><?php if ($matriculantMapper->checkUser($matriculant)) :?>
            <a href="login.php">Редактировать данные</a>
        <?php else: ?>
            <a href="login.php">Зарегистрироваться</a>
        <?php endif; ?>  
        </li>
</ul>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="form-search navbar-form pull-right">
        <input type="text" name="userSearch" class="input-medium search-query">
        <button type="submit" class="btn">Search</button>
    </form>
</div></div></div>

<div class="container">
<div class="page-header"><h1>Главная страница</h1></div>

<table class='table'>
<?php if ($userSearch <> '' ): ?>   
    Поиск по запросу "<?= $userSearch ?>"
<?php endif; ?>  
    <thead>
        <tr>
        <!-- тут выводятся заголовки колонок           -->
            <?php foreach ($columns as $key => $value): ?> <!-- находится в config.php -->
                <th><a href='<?= h($pager->getSortLink($key)); ?>'>
                    <!--<?= $pager->getArrow($key); ?> стрелка расширяет колонку   -->
                <?=$value ?>
                </a></th>
            <?php endforeach  ?>
        </tr>
    </thead>

<!-- тут выводятся таблица внешний цикл выводит по строчно          -->
    <?php foreach ($listMatriculant as $key => $value): ?>
        <tr class="table-hover">
        <!-- внутренний цикл по ячейке.    -->
            <?php foreach ($columns as $keyColumn => $valueColumn): ?>
                <td><?= h($listMatriculant[$key][$keyColumn]); ?></td>
            <?php endforeach  ?>
        </tr>
    <?php endforeach  ?>
</table>


<div class="pagination">
    <ul>
    <?php if ($pager->curentPage == 1): ?>
        <li class="disabled"><a href="">Prev</a></li>
    <?php else: ?>
        <li><a href="<?= $pager->getPreviousPage() ?>">Prev</a></li>
    <?php endif; ?>    
    
<!-- формируем циферки со ссылками на странички           -->
    <?php foreach ($pager->getLinks() as $text => $link): ?>
        <?php if ($pager->curentPage == $text): ?>
            <li class="active"><a href=""><?= h($text); ?></a></li>
        <?php else: ?>
            <li><a href="<?= h($link); ?>"><?= h($text); ?></a></li>
        <?php endif; ?>
    <?php endforeach ?>

    <?php if ($pager->curentPage == $pager->countPage): ?>
        <li class="disabled"><a href="">Next</a></li>
    <?php else: ?>
        <li><a href="<?= $pager->getNextPage() ?>">Next</a></li>
    <?php endif; ?>
    </ul>
</div>

</div>
<?php include('templates/footer.php'); ?>

