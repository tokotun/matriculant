<?php 
//класс, который хранит переменные для шаблона
Class Template
{
	protected $loggedIn; //произведен ли вход

	public function __construct(PDO $db)
    {
        $this->db = $db;
    }

	public function isLoggedIn($id, $code)
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

	public function checkloggedIn()
	{
		return $this->loggedIn;
	}

}