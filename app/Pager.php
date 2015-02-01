<?php 
Class Pager
{
    public $curentPage;
    public $countPage;
    public $sort;
    public $order;
    public $userSearch;

    function setPage($curentPage, $countPage, $sort, $order, $userSearch)
    {
        $this->curentPage   = $curentPage;
        $this->countPage    = $countPage;
        $this->sort         = $sort;
        $this->order        = $order;
        $this->userSearch   = $userSearch;
    }

//формирует линк с данными для сортировки
    function getLinks()
    {
        $links = array();
        if ($this->countPage==1) return $links; //если страница 1, то ссылки не нужны. Выходим из функции
        for ($i = 1; $i <= $this->countPage; $i++) {
         
            $links[$i] = $_SERVER['PHP_SELF'] .
                '?sort=' . $this->sort .
                '&order=' . $this->order .
                '&userSearch=' . $this->userSearch .
                '&page=' . $i;
        }
        
        return $links;
    }

    function getPreviousPage()
    {
        if ($this->curentPage==1) return ''; //если страница первая, то предыдущей ссылки нет. Выходим из функции
        $link = $_SERVER['PHP_SELF'] .
                '?sort=' . $this->sort .
                '&order=' . $this->order .
                '&userSearch=' . $this->userSearch .
                '&page=' . ($this->curentPage-1);
        return $link;
    }

    function getNextPage()
    {   

        if ($this->curentPage==$this->countPage) return ''; //если страница последняя, то следующей ссылки нет. Выходим из функции
        
        $link = $_SERVER['PHP_SELF'] .
                '?sort=' . $this->sort .
                '&order=' . $this->order .
                '&userSearch=' . $this->userSearch .
                '&page=' . ($this->curentPage+1);
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
        $sortLink .= '&userSearch=' . $this->userSearch;
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