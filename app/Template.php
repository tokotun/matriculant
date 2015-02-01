<?php 
//класс, который хранит переменные для шаблона
Class Template
{
	public $loggedIn; //произведен ли вход

	public function __construct(PDO $db)
    {
        $this->db = $db;
    }

	function isLoggedIn($id, $code)
	{           
	    $sql = "SELECT count(*) FROM matriculant WHERE id=:id and code=:code";
	    $statment = $this->db->prepare($sql);
	    $statment->bindValue(':id', $id);
	    $statment->bindValue(':code', $code);
	    $statment->execute();
	    $result = $statment->fetchColumn();
	    if ($result > 0) {
	        $this->loggedIn = true;
	    }else{
	        $this->loggedIn = false;
	    }
	}

}