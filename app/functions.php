<?php

function viewTableMatriculant($listMatriculant)
{
	//функция используется в ..templates/main.php
    foreach ($listMatriculant as $key => $value) {
        $name =         htmlspecialchars($listMatriculant[$key]['name']);
        $surname =      htmlspecialchars($listMatriculant[$key]['surname']);
        $numberGroup =  htmlspecialchars($listMatriculant[$key]['numberGroup']);
        $score =        htmlspecialchars($listMatriculant[$key]['score']);
        include('templates/tableMatriculant.php');
    }   
}

function generate_page_links($sort, $order, $cur_page, $num_pages) //генерирует ссылки на страница абитуринтов
{ 
    if ($num_pages==1) return; //если страница 1, то ссылки не нужны. Выходим из функции
    $page_links = '';
    //если это не первая страница, то создаём знак << со ссылкой
    if ($cur_page > 1) {
        $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . 

            '?sort=' . $sort .
            '&order=' . $order .
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
                '&order=' . $order .
                '&page=' . $i .'"> ' . $i . '</a>';
        }
    }

    // Если это не последняя страница - создание гиперссылки "следующая страница"
    if ($cur_page < $num_pages){
        $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] .
            '?sort=' . $sort .
            '&order=' . $order .
            '&page=' . ($cur_page + 1) . '">>></a>';
    }
    else {
        $page_links .= ' >>';
    }
    return $page_links;
}

function generate_sort_link($sort, $order, $column, $nameColumn)
{
	//по какой-то причине в GET-запрос идёт только имя,

	$sort_link = '';

	$sort_link .= '<th><a href=' . $_SERVER['PHP_SELF'] . '?sort='. $column;
	if ($sort == $column){
		if ($order == 'ASC'){
			$sort_link .= '&order=DESC>&#9660;';
			$sort_link .= $nameColumn . '</a></th>';
		} else{
			$sort_link .= '&order=ASC>&#9650;';
			$sort_link .= $nameColumn . '</a></th>';
		}
	}else {
		$sort_link .= '&order=ASC>';
		$sort_link .= $nameColumn . '</a></th>';
	}
	return $sort_link;
}

//функция сосдаёт ссылки на заголовки колонок, для сортировки.
function generate_sort_links($sort, $order)
{
	$sort_links = '';

	$sort_links .= generate_sort_link($sort, $order, 'name', 'First Name');
	$sort_links .= generate_sort_link($sort, $order, 'surname', 'Last Name');
	$sort_links .= generate_sort_link($sort, $order, 'numberGroup', 'Number Group');
	$sort_links .= generate_sort_link($sort, $order, 'score', 'Score');

    return $sort_links;        
}
