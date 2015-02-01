<?php include('templates/header.php');?>

<div class="container">
    <div class="page-header">
        <h1>Главная страница</h1>
    </div>

    <table class='table'>
    <?php if ($userSearch <> '' ): ?>   
        <p>Поиск по запросу "<?= h($userSearch) ?>"</p>
        <a href="index.php">Показать всех абитуриентов</a>
    <?php endif; ?>  
        <thead>
            <tr>
            <!-- тут выводятся заголовки колонок           -->
                <?php foreach ($columns as $key => $value): ?> <!-- находится в config.php -->
                    <th>
                        <a href='<?= h($pager->getSortLink($key)); ?>'>
                        <?= $pager->getArrow($key); ?><?=$value ?>
                        </a>
                    </th>
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

    <?php if ($pager->countPage > 1): ?>
        <div class="pagination">
            <ul>
            <?php if ($pager->curentPage == 1): ?>
                <li class="disabled"><span>Prev</span></li>
            <?php else: ?>
                <li><a href="<?= $pager->getPreviousPage() ?>">Prev</a></li>
            <?php endif; ?>    
            
        <!-- формируем циферки со ссылками на странички           -->
            <?php foreach ($pager->getLinks() as $text => $link): ?>
                <?php if ($pager->curentPage == $text): ?>
                    <li class="active"><span><?= h($text); ?></span></li>
                <?php else: ?>
                    <li><a href="<?= h($link); ?>"><?= h($text); ?></a></li>
                <?php endif; ?>
            <?php endforeach ?>

            <?php if ($pager->curentPage == $pager->countPage): ?>
                <li class="disabled"><span>Next</span></li>
            <?php else: ?>
                <li><a href="<?= $pager->getNextPage() ?>">Next</a></li>
            <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?> 
</div>
<?php include('templates/footer.php'); ?>

