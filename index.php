<?php
include 'config.php';                  //тут находятся параметры для подключения к БД  
include 'app/functions.php';

include 'app/autoloader.php';
spl_autoload_register('autoloader');

$curentPage = isset($_GET['page']) ? $_GET['page'] : 1; //если номер страницы не указан, то это первая страница

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'score';// тут  принимается переменная колонки для сортировки

$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';  // и переменная с направлением сортировки

require_once('app/boostrap.php');


$listMatriculant = $matriculantMapper->viewMatriculant($curentPage, $sort, $order, $result_per_page, $columns); //берёт список абитуриентов из базы данных

$total  = $matriculantMapper->totalMatriculant(); //всего записей в таблице

$countPage = ceil($total/$result_per_page);     //вот столько нам понадобится страниц для всех абитуриентов

$pager = new Pager;
$pager->setPage($curentPage, $countPage, $sort, $order);

include 'templates/main.php';