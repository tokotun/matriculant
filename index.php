<?php
include('config.php');
include('app/MatriculantMapper.php');

function viewTableMatriculant($listMatriculant)
{
    foreach ($listMatriculant as $key => $value) {
        $name =         htmlspecialchars($listMatriculant[$key]['name']);
        $surname =      htmlspecialchars($listMatriculant[$key]['surname']);
        $numberGroup =  htmlspecialchars($listMatriculant[$key]['numberGroup']);
        $score =        htmlspecialchars($listMatriculant[$key]['score']);
        include('templates/tableMatriculant.php');
    }   
}

function generate_page_links($sort, $cur_page, $num_pages) //генерирует ссылки на страница абитуринтов
{ 
    if ($num_pages==1) return; //если страница 1, то ссылки не нужны. Выходим из функции
    $page_links = '';
    //если это не первая страница, то создаём знак << со ссылкой
    if ($cur_page > 1) {
        $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . 

            '?sort=' . $sort .
            '&page=' . ($cur_page - 1) . '"><<</a>';
    }
    else {
        $page_links .= '<< ';
    }

    for ($i = 1; $i <= $num_pages; $i++) {
        if ($cur_page == $i){
            $page_links .= ' ' . $i;
        }
        else{
            $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] .
                '?sort=' . $sort .
                '&page=' . $i .'"> ' . $i . '</a>';
        }
    }

    // Если это не последняя страница - создание гиперссылки "следующая страница"
    if ($cur_page < $num_pages){
        $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] .
            '?sort=' . $sort .
            '&page=' . ($cur_page + 1) . '">>></a>';
    }
    else {
        $page_links .= ' >>';
    }
    return $page_links;
}


/* тут в будущем будет приниматся переменная колонки для сортировки
$sort = $_GET['sort'];
и переменная с направлением сортировки
$sort_way
*/
$sort = 'name';
$sort_way = TRUE;

$cur_page = isset($_GET['page']) ? $_GET['page'] : 1; //если номер страницы не указан, то это первая страница

$dbc = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
$pdo = new PDO($dbc, $db_user, $db_password);
$matriculantMapper = new MatriculantMapper($pdo);
$pdo = null;

$listMatriculant = $matriculantMapper->viewMatriculant($cur_page, $sort, $sort_way, $result_per_page); //берёт список абитуриентов из базы данных
$total  = $matriculantMapper->totalMatriculant(); //всего записей в таблице

$num_pages = ceil($total/$result_per_page);     //вот столько нам понадобится страниц для всех абитуриентов

$page_links = generate_page_links($sort, $cur_page, $num_pages);
include('templates/main.php');
