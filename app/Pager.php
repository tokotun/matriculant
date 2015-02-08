<?php 
Class Pager
{
    protected $curentPage;
    protected $countPage;
    protected $sort;
    protected $order;
    protected $userSearch;

    function getCurentPage()
    {
        return $this->curentPage;
    }

    function getCountPage()
    {
        return $this->countPage;
    }

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
         
            $data = array(  'sort'  =>$this->sort,
                'order' =>$this->order,
                'userSearch'=>$this->userSearch,
                'page'  =>$i );
            
            $links[$i] = $_SERVER['PHP_SELF'] . '?' . http_build_query($data);
        }
        
        return $links;
    }

    function getPreviousPage()
    {
        if ($this->curentPage==1) return ''; //если страница первая, то предыдущей ссылки нет. Выходим из функции
        
        $data = array(  'sort'  =>$this->sort,
                'order' =>$this->order,
                'userSearch'=>$this->userSearch,
                'page'  =>($this->curentPage-1) );
            
            $link = $_SERVER['PHP_SELF'] . '?' . http_build_query($data);
        return $link;
    }

    function getNextPage()
    {   

        if ($this->curentPage==$this->countPage) return ''; //если страница последняя, то следующей ссылки нет. Выходим из функции
        $data = array(  'sort'  =>$this->sort,
                'order' =>$this->order,
                'userSearch'=>$this->userSearch,
                'page'  =>($this->curentPage+1) );
            
            $link = $_SERVER['PHP_SELF'] . '?' . http_build_query($data);
        return $link;
    }

    function getSortLink($nameColumn)
    {
        $data = array('sort'  => $nameColumn);
        if (($nameColumn <> $this->sort) or ($this->order=='DESC')){
            $data['order'] = 'ASC';
        } else {
            $data['order'] = 'DESC';
        }
        $data['userSearch'] = $this->userSearch;
    
        $sortLink = $_SERVER['PHP_SELF'] . '?' . http_build_query($data);
        
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