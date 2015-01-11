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
        if (isset($matriculant->id))  $statment->bindParam(':id', $matriculant->id);
        if (isset($matriculant->code)) $statment->bindParam(':code', $matriculant->code);
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
        $sql = "INSERT INTO matriculant (code, name, surname, sex, numberGroup, email, score, yearOfBirth, location)
        VALUES (:code, :name, :surname, :sex, :numberGroup, :email, :score, :yearOfBirth, :location)";
        $statment = $this->db->prepare($sql);
        $matriculant->code = mt_rand ( 0 , 2097151 );
        $this->bindField($statment, $matriculant);
        $statment->execute();
        $matriculant->id = $this->db->lastInsertId();
    }

    public function updateMatriculant(Matriculant $matriculant)
    {
        $sql = "UPDATE matriculant SET name=:name, surname=:surname, sex=:sex, 
        numberGroup=:numberGroup, email=:email, score=:score, yearOfBirth=:yearOfBirth, 
        location=:location WHERE id=:id and code=:code";
        $statment = $this->db->prepare($sql);
        $this->bindField($statment, $matriculant);
        $statment->execute();
    }

    public function readMatriculant(Matriculant $matriculant)
    {   
        $sql = "SELECT * FROM matriculant WHERE id=:id and code=:code";
        $statment = $this->db->prepare($sql);
        $statment->bindParam(':id', $matriculant->id);
        $statment->bindParam(':code', $matriculant->code);
        $statment->execute();

        $result = $statment->fetch();

        $matriculant->name =        $result['name'];
        $matriculant->surname =     $result['surname'];
        $matriculant->sex =         $result['sex'];
        $matriculant->numberGroup = $result['numberGroup'];
        $matriculant->email =       $result['email'];
        $matriculant->score =       $result['score'];
        $matriculant->yearOfBirth = $result['yearOfBirth'];
        $matriculant->location =    $result['location'];
    }

    public function viewMatriculant($cur_page, $sort, $order, $result_per_page) //выбирает из базы абитуриентов. 
                    //пременные- номер страницы, способ сортировки, кол-во записей на страницу
    {
        $skip_result = ($cur_page - 1) * $result_per_page;

        $allowed = array("name", "surname", "numberGroup","score"); //перечисляем параметры
        $key     = array_search($sort, $allowed); // ищем среди них переданный параметр
        $orderby = $allowed[$key]; //выбираем найденный (или, за счёт приведения типов - первый) элемент. 
        $order   = ($order == 'DESC') ? 'DESC' : 'ASC'; // определяем направление сортировки
                                                        //запрос теперь 100% безопасен


        $sql = "SELECT name, surname, numberGroup, score FROM matriculant ORDER BY $orderby $order LIMIT :skip_result, :result_per_page";
        $statment = $this->db->prepare($sql);
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