<?php

class MatriculantMapper
{
    protected $db;
    public $recorded = FALSE;
    public $loggedIn;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    protected function bindField($statment, Matriculant $matriculant, $needId = FALSE, $needCode = FALSE)
    {
        if ( $needId )  $statment->bindValue(':id', $matriculant->id);
        if ( $needCode ) $statment->bindValue(':code', $matriculant->code);
        $statment->bindValue(':name',       $matriculant->name);
        $statment->bindValue(':surname',    $matriculant->surname);
        $statment->bindValue(':sex',        $matriculant->sex);
        $statment->bindValue(':numberGroup', $matriculant->numberGroup);
        $statment->bindValue(':email',      $matriculant->email);
        $statment->bindValue(':score',      $matriculant->score);
        $statment->bindValue(':yearOfBirth', $matriculant->yearOfBirth);
        $statment->bindValue(':location',   $matriculant->location);
    }


    public function saveMatriculant(Matriculant $matriculant)
    {
        $sql = "INSERT INTO matriculant (code, name, surname, sex, numberGroup, email, score, yearOfBirth, location)
        VALUES (:code, :name, :surname, :sex, :numberGroup, :email, :score, :yearOfBirth, :location)";
        $statment = $this->db->prepare($sql);
        $this->bindField($statment, $matriculant, FALSE, TRUE);
        $statment->execute();
        $matriculant->id = $this->db->lastInsertId();
        $this->recorded = TRUE;
    }

    public function updateMatriculant(Matriculant $matriculant)
    {
        $sql = "UPDATE matriculant SET name=:name, surname=:surname, sex=:sex, 
        numberGroup=:numberGroup, email=:email, score=:score, yearOfBirth=:yearOfBirth, 
        location=:location WHERE id=:id and code=:code";
        $statment = $this->db->prepare($sql);
        $this->bindField($statment, $matriculant, TRUE, TRUE);
        $statment->execute();
        $this->recorded = TRUE;
    }

    public function readMatriculant($id, $code)
    {   
        $sql = "SELECT * FROM matriculant WHERE id=:id and code=:code";
        $statment = $this->db->prepare($sql);
        $statment->bindValue(':id', $id);
        $statment->bindValue(':code', $code);
        $statment->execute();
        
        $result = $statment->fetch(PDO::FETCH_ASSOC); 
        $matriculant = new Matriculant;  

        if (isset($result)) 
        {
            $matriculant->setData($result);   
            return $matriculant;
        } else {
            return FALSE;
        }
    }

    public function viewMatriculant($curPage, $sort, $order, $userSearch, $resultPerPage, $columns) //выбирает из базы абитуриентов. 
                    //пременные- номер страницы, способ сортировки, кол-во записей на страницу
    {
        $skipResult = ($curPage - 1) * $resultPerPage;

        $allowed = array();
        foreach ($columns as $keyColumn => $valueColumn) {$allowed[] = $keyColumn;}        //передача названий колонок

        $key     = array_search($sort, $allowed); // ищем среди них переданный параметр
        $orderBy = $allowed[$key]; //выбираем найденный (или, за счёт приведения типов - первый) элемент. 
        $order   = ($order == 'DESC') ? 'DESC' : 'ASC'; // определяем направление сортировки
                                                        //запрос теперь 100% безопасен
        $search = "%$userSearch%";
        $sql = "SELECT * FROM matriculant WHERE name LIKE ? OR surname LIKE ? OR numberGroup LIKE ? OR score LIKE ? ORDER BY $orderBy $order LIMIT ?, ?";
        $statment = $this->db->prepare($sql);
        $statment->bindParam(1, $search);
        $statment->bindParam(2, $search);
        $statment->bindParam(3, $search);
        $statment->bindParam(4, $search);
        $statment->bindParam(5, $skipResult, PDO::PARAM_INT);
        $statment->bindParam(6, $resultPerPage, PDO::PARAM_INT);
        $statment->execute();
        $result = $statment->fetchAll();
        return $result;
    }

    public function totalMatriculant($userSearch)
    {

        $sql = "SELECT count(*) FROM matriculant WHERE name LIKE ? OR surname LIKE ? OR numberGroup LIKE ? OR score LIKE ?";
        $statment = $this->db->prepare($sql);
        $search = "%$userSearch%";
        $statment->bindParam(1, $search);
        $statment->bindParam(2, $search);
        $statment->bindParam(3, $search);
        $statment->bindParam(4, $search);
        $statment->execute();
        
        $total = $statment->fetch();
        return $total[0];
        
    }
    
    public function checkUniquenessEmail($email)
    {
        $sql = "SELECT email FROM matriculant WHERE email=:email and id<>:id";
        $statment = $this->db->prepare($sql);
        $statment->bindParam(':id', $this->id);
        $statment->bindParam(':email', $email);
        $statment->execute();

        $result = $statment->fetch();
        if (empty($result)){
            //емайл уникален
            return TRUE;
        }else{
            //емайл уже занят
            return FALSE;
        }
    }

    function isLoggedIn($id, $code)
    {           
        $sql = "SELECT count(*) FROM matriculant WHERE id=:id and code=:code";
        $statment = $this->db->prepare($sql);
        $statment->bindValue(':id', $id);
        $statment->bindValue(':code', $code);
        $statment->execute();
        $result = $statment->fetch();
        if ($result) {
            $this->loggedIn = TRUE;
        }else{
            $this->loggedIn = FALSE;
        }
    }
}