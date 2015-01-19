<?php 
Class Pager
{
	public $curentPage;
	public $countPage;
	public $sort;
	public $order;

	function setPage($curentPage, $countPage, $sort, $order)
	{
		$this->curentPage 	= $curentPage;
		$this->countPage 	= $countPage;
		$this->sort 		= $sort;
		$this->order 		= $order;
	}


//формирует линк с данными для сортировки
	function getLinks()
	{
		if ($this->countPage==1) return ''; //если страница 1, то ссылки не нужны. Выходим из функции
		$links = array();
		for ($i = 1; $i <= $this->countPage; $i++) {
	        $links[$i] = $_SERVER['PHP_SELF'] .
	        	'?sort=' . $this->sort .
	        	'&amp;order=' . $this->order .
	        	'&amp;page=' . $i;
    	}
		return $links;
	}
	function getPreviousPage()
	{
		if ($this->curentPage==1) return ''; //если страница первая, то предыдущей ссылки нет. Выходим из функции
		$link = $_SERVER['PHP_SELF'] .
	        	'?sort=' . $this->sort .
	        	'&amp;order=' . $this->order .
	        	'&amp;page=' . ($this->curentPage-1);
	    return $link;
	}

	function getNextPage()
	{	
		if ($this->curentPage==$this->countPage) return ''; //если страница последняя, то следующей ссылки нет. Выходим из функции
		
		$link = $_SERVER['PHP_SELF'] .
	        	'?sort=' . $this->sort .
	        	'&amp;order=' . $this->order .
	        	'&amp;page=' . ($this->curentPage+1);
	    return $link;
	}

	function getSortLink($nameColumn)
	{
		$sortLink = $_SERVER['PHP_SELF'] . '?sort=' . $nameColumn . '&order=';
		if (($nameColumn <> $this->sort) or ($this->order=='DESC')) 
		{
			$sortLink .= 'ASC';
		}else{
			$sortLink .= 'DESC';
		}
		return $sortLink;
	}

	function getArrow($nameColumn) //выдаёт такие треугольники в зависимости от способа сортировки ▼ ▲
	{
		if ($nameColumn == $this->sort)
		{
			if ($this->order=='ASC') {
				return "&#9650;";
			}else{
				return "&#9660;";
			}
		}
	}
}