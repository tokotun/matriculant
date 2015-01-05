<?php

class MatriculantMapper
{
	protected $db;

	public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function bindField($statment, Matriculant $matriculant)
    {
        if (isset($matriculant->id)) $statment->bindParam(':id', $matriculant->id);
        $statment->bindParam(':name',       $matriculant->name);
        $statment->bindParam(':surname',    $matriculant->surname);
        $statment->bindParam(':sex',        $matriculant->sex);
        $statment->bindParam(':numberGroup', $matriculant->numberGroup);
        $statment->bindParam(':email',      $matriculant->email);
        $statment->bindParam(':score',      $matriculant->score);
        $statment->bindParam(':yearOfBirth', $matriculant->yearOfBirth);
        $statment->bindParam(':location',   $matriculant->location);
    }

    public function saveMatriculant(Matriculant $matriculant)
    {
    	if (!isset($matriculant->id)){
    		$sql = "INSERT INTO matriculant (name, surname, sex, numberGroup, email, score, yearOfBirth, location)
			VALUES (:name, :surname, :sex, :numberGroup, :email, :score, :yearOfBirth, :location)";
    		$statment = $this->db->prepare($sql);
    		$this->bindField($statment, $matriculant);
            $statment->execute();
			$matriculant->id = $this->db->lastInsertId();
            
    	} 
    	else {
    		$sql = "UPDATE matriculant SET name=:name, surname=:surname, sex=:sex, 
			numberGroup=:numberGroup, email=:email, score=:score, yearOfBirth=:yearOfBirth, 
			location=:location WHERE id=:id";
    		$statment = $this->db->prepare($sql);
    		$this->bindField($statment, $matriculant);
            $statment->execute();
    	}
    }

    public function readMatriculant(Matriculant $matriculant)
    {
    	$sql = "SELECT * FROM matriculant WHERE id=:id";
    	$statment = $this->db->prepare($sql);
    	$statment->bindParam(':id', $matriculant->id);
		$statment->execute();

		$result = $statment->fetch();

		$matriculant->name = 		htmlspecialchars($result['name']);
		$matriculant->surname = 	htmlspecialchars($result['surname']);
		$matriculant->sex = 		$result['sex'];
		$matriculant->numberGroup = htmlspecialchars($result['numberGroup']);
		$matriculant->email = 		htmlspecialchars($result['email']);
		$matriculant->score = 		$result['score'];
		$matriculant->yearOfBirth = $result['yearOfBirth'];
		$matriculant->location = 	$result['location'];
    }

    public function viewMatriculant($cur_page, $sort, $sort_way, $result_per_page) //выбирает из базы абитуриентов. 
                    //пременные- номер страницы, способ сортировки, кол-во записей на страницу
    {
        $way = '';
        $skip_result = ($cur_page - 1) * $result_per_page;
        //подготавливаю переменную для SQL запроса
        switch ($sort_way){
            case FALSE :  
                $way = 'DESC';
                break;
            default :     $way = 'ASC';
        }


        //PDO не принимает :sort  =(  .Позже нужно испрвить.
        $sql = "SELECT name, surname, numberGroup, score FROM matriculant ORDER BY :sort ".$way." LIMIT :skip_result, :result_per_page";
        $statment = $this->db->prepare($sql);
        $statment->bindParam(':sort', $sort);
        $statment->bindParam(':skip_result', $skip_result, PDO::PARAM_INT);
        $statment->bindParam(':result_per_page', $result_per_page, PDO::PARAM_INT);
        $statment->execute();
        $result = $statment->fetchAll();
        return $result;
    }

    public function totalMatriculant()
    {
        $sql = "SELECT * FROM matriculant";
        $statment = $this->db->prepare($sql);
        $statment->execute();

        $total = $statment->rowCount();
        return $total;
    }
    
}