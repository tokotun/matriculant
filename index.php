<?php
include('config.php');
include('app/functions.php');
include('app/autoloader.php');
spl_autoload_register('autoloader');

$cur_page = isset($_GET['page']) ? $_GET['page'] : 1; //если номер страницы не указан, то это первая страница

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'score';// тут  принимается переменная колонки для сортировки

$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';  // и переменная с направлением сортировки

$dbc = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
$pdo = new PDO($dbc, $db_user, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$matriculantMapper = new MatriculantMapper($pdo);
$pdo = null;

$listMatriculant = $matriculantMapper->viewMatriculant($cur_page, $sort, $order, $result_per_page); //берёт список абитуриентов из базы данных
$total  = $matriculantMapper->totalMatriculant(); //всего записей в таблице

$num_pages = ceil($total/$result_per_page);     //вот столько нам понадобится страниц для всех абитуриентов

$page_links = generate_page_links($sort, $order, $cur_page, $num_pages);
$sort_links = generate_sort_links($sort, $order);

include('templates/main.php');
