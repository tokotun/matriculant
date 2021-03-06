<?php

class MatriculantMapper
{
    protected $db;
    

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    protected function bindField( PDOStatement  $statment, Matriculant $matriculant, $needId = false, $needCode = false)
    {
        if ( $needId ) {
            $statment->bindValue(':id', $matriculant->getId());
        }
        if ( $needCode ) {
            $statment->bindValue(':code', $matriculant->getCode());
        }
        $statment->bindValue(':name',        $matriculant->getName());
        $statment->bindValue(':surname',     $matriculant->getSurname());
        $statment->bindValue(':sex',         $matriculant->getSex());
        $statment->bindValue(':numberGroup', $matriculant->getNumberGroup());
        $statment->bindValue(':email',       $matriculant->getEmail());
        $statment->bindValue(':score',       $matriculant->getScore());
        $statment->bindValue(':yearOfBirth', $matriculant->getYearOfBirth());
        $statment->bindValue(':location',    $matriculant->getLocation());
    }


    public function saveMatriculant(Matriculant $matriculant)
    {
        $sql = "INSERT INTO matriculant (code,  name,  surname,   sex,  numberGroup,  email,  score,  yearOfBirth,  location)
                                 VALUES (:code, :name, :surname, :sex, :numberGroup, :email, :score, :yearOfBirth, :location)";
        $statment = $this->db->prepare($sql);
        $this->bindField($statment, $matriculant, false, true);
        $statment->execute();
        $id = $this->db->lastInsertId();
        $matriculant->setId($id);
    }

    public function updateMatriculant(Matriculant $matriculant)
    {
        $sql = "UPDATE matriculant SET name=:name, surname=:surname, sex=:sex, 
            numberGroup=:numberGroup, email=:email, score=:score, yearOfBirth=:yearOfBirth, 
            location=:location WHERE id=:id and code=:code";
        $statment = $this->db->prepare($sql);
        $this->bindField($statment, $matriculant, true, true);
        $statment->execute();
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

        if (isset($result)) {
            $matriculant->setData($result);   
            return $matriculant;
        } else {
            return false;
        }
    }

   /**
    * viewMatriculant() выбирает из базы абитуриентов. 
    * @param int $curPage, string $sort, string $order, string $userSearch, int $resultPerPage
    */
    public function viewMatriculant( $curPage, $sort, $order, $userSearch, $resultPerPage)  
    {
        $skipResult = ($curPage - 1) * $resultPerPage;

        $allowed = array();

        //названий колонок
        $allowed = array('name', 'surname', 'numberGroup', 'score');

        $key     = array_search($sort, $allowed); // ищем среди них переданный параметр
        $orderBy = $allowed[$key];    //выбираем найденный (или, за счёт приведения типов - первый) элемент. 
        $order   = ($order == 'DESC') ? 'DESC' : 'ASC'; // определяем направление сортировки
                                                        //запрос теперь 100% безопасен
        $search = "%$userSearch%";
        $sql = "SELECT * FROM matriculant WHERE name LIKE ? OR surname LIKE ? OR 
            numberGroup LIKE ? OR score LIKE ? ORDER BY $orderBy $order LIMIT ?, ?";
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
        $sql =  "SELECT count(*) FROM matriculant WHERE 
            name LIKE ? OR surname LIKE ? OR numberGroup LIKE ? OR score LIKE ?";
        $statment = $this->db->prepare($sql);
        $search = "%$userSearch%";
        $statment->bindParam(1, $search);
        $statment->bindParam(2, $search);
        $statment->bindParam(3, $search);
        $statment->bindParam(4, $search);
        $statment->execute();
        
        $total = $statment->fetchColumn();
        return $total;        
    }
    
    public function checkUniquenessEmail($matriculant)
    {
        $id    = $matriculant->getId();
        $email = $matriculant->getEmail();


        $sql = "SELECT count(email) FROM matriculant WHERE email=:email and id<>:id";
        $statment = $this->db->prepare($sql);
        $statment->bindParam(':id', $id);
        $statment->bindParam(':email', $email);
        $statment->execute();

        $total = $statment->fetchColumn();
        if ($total == 0) {   
            return true; //емайл уникален
        }else{     
            return false; //емайл уже занят
        }
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
            return true;
        }else{
            return false;
        }
    }
}
