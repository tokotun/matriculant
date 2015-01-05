<?php
class Matriculant
{
	public $id;
	public $name;
	public $surname;
	public $sex;
	public $numberGroup;
	public $email;
	public $score;
	public $yearOfBirth;
	public $location;

	//тут будут всякие функции на проверку правильности ввода и тому подобное
	
}

class MatriculantMapper
{
	protected $db;

	public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function saveMatriculant(Matriculant &$matriculant)
    {
    	if (!isset($matriculant->id)){
    		$sql = "INSERT INTO matriculant (name, surname, sex, numberGroup, email, score, yearOfBirth, location)
			VALUES (:name, :surname, :sex, :numberGroup, :email, :score, :yearOfBirth, :location)";
    		$statment = $this->db->prepare($sql);

    		$statment->bindParam(':name', $matriculant->name);
			$statment->bindParam(':surname', $matriculant->surname);
			$statment->bindParam(':sex', $matriculant->sex);
			$statment->bindParam(':numberGroup', $matriculant->numberGroup);
			$statment->bindParam(':email', $matriculant->email);
			$statment->bindParam(':score', $matriculant->score);
			$statment->bindParam(':yearOfBirth', $matriculant->yearOfBirth);
			$statment->bindParam(':location', $matriculant->location);

			$statment->execute();
			//Сохраняем в куки ID только что зарегистрированного абитуриента.
			$matriculant->id = $this->db->lastInsertId();
			setcookie('id', $matriculant->id, time() + (3600*24*365*10)); //срок действия чуть меньше 10 лет

    	} 
    	else {
    		$sql = "UPDATE matriculant SET name=:name, surname=:surname, sex=:sex, 
			numberGroup=:numberGroup, email=:email, score=:score, yearOfBirth=:yearOfBirth, 
			location=:location WHERE id=:id";
    		$statment = $this->db->prepare($sql);

    		$statment->bindParam(':id', $matriculant->id);
    		$statment->bindParam(':name', $matriculant->name);
			$statment->bindParam(':surname', $matriculant->surname);
			$statment->bindParam(':sex', $matriculant->sex);
			$statment->bindParam(':numberGroup', $matriculant->numberGroup);
			$statment->bindParam(':email', $matriculant->email);
			$statment->bindParam(':score', $matriculant->score);
			$statment->bindParam(':yearOfBirth', $matriculant->yearOfBirth);
			$statment->bindParam(':location', $matriculant->location);

			$statment->execute();
    	}
    }

    public function viewMatriculant(Matriculant &$matriculant)
    {
    	$sql = "SELECT * FROM matriculant WHERE id=:id";
    	$statment = $this->db->prepare($sql);
    	$statment->bindParam(':id', $matriculant->id);
		$statment->execute();

		$result = $statment->fetch();

		$matriculant->name = 		$result['name'];
		$matriculant->surname = 	$result['surname'];
		$matriculant->sex = 		$result['sex'];
		$matriculant->numberGroup = $result['numberGroup'];
		$matriculant->email = 		$result['email'];
		$matriculant->score = 		$result['score'];
		$matriculant->yearOfBirth = $result['yearOfBirth'];
		$matriculant->location = 	$result['location'];
    }

    
}