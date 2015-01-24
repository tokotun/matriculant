<?php
require_once 'app/boostrap.php';

$curentPage = isset($_GET['page']) ? $_GET['page'] : 1; //если номер страницы не указан, то это первая страница

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'score';// тут  принимается переменная колонки для сортировки

$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';  // переменная с направлением сортировки

$userSearch = isset($_GET['userSearch']) ? trim($_GET['userSearch']) : ''; // и слова для поиска


$listMatriculant = $matriculantMapper->viewMatriculant($curentPage, $sort, $order, $userSearch, $resultPerPage, $columns); //берёт список абитуриентов из базы данных

$total  = $matriculantMapper->totalMatriculant($userSearch); //всего записей в таблице


$countPage = ceil($total/$resultPerPage); //вот столько нам понадобится страниц для всех абитуриентов    
if ($countPage == 0) $countPage =1; 

$pager = new Pager;

$pager->setPage($curentPage, $countPage, $sort, $order, $userSearch);

$matriculant = new Matriculant;
$sentData = getLoginData();
$matriculant->setData($sentData);

include 'templates/main.php';