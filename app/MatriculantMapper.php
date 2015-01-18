<?php

class MatriculantMapper
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    protected function bindField($statment, Matriculant $matriculant)
    {
        if ($matriculant->id <> '')  $statment->bindParam(':id', $matriculant->id);
        if ($matriculant->code <>'') $statment->bindParam(':code', $matriculant->code);
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

    public function viewMatriculant($cur_page, $sort, $order, $result_per_page, $columns) //выбирает из базы абитуриентов. 
                    //пременные- номер страницы, способ сортировки, кол-во записей на страницу
    {
        $skip_result = ($cur_page - 1) * $result_per_page;

        $allowed = array();
        foreach ($columns as $keyColumn => $valueColumn) {$allowed[] = $keyColumn;}        //передача названий колонок

        $key     = array_search($sort, $allowed); // ищем среди них переданный параметр
        $orderBy = $allowed[$key]; //выбираем найденный (или, за счёт приведения типов - первый) элемент. 
        $order   = ($order == 'DESC') ? 'DESC' : 'ASC'; // определяем направление сортировки
                                                        //запрос теперь 100% безопасен

        $selectField = '';
        foreach ($columns as $keyColumn => $valueColumn) {$selectField .= $keyColumn . ', ';}   //формируется строчка для запроса
        $selectField = substr($selectField, 0, -2); //удаляем лишнюю запятую в конце

        $sql = "SELECT " . $selectField . " FROM matriculant ORDER BY $orderBy $order LIMIT :skip_result, :result_per_page";
        $statment = $this->db->prepare($sql);
        $statment->bindParam(':skip_result', $skip_result, PDO::PARAM_INT);
        $statment->bindParam(':result_per_page', $result_per_page, PDO::PARAM_INT);
        $statment->execute();
        $result = $statment->fetchAll();
        return $result;
    }

    public function totalMatriculant()
    {
        $sql = "SELECT count(*) FROM matriculant";
        $statment = $this->db->prepare($sql);
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
}