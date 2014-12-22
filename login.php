<?php
include('connectvars.php');

if (isset($_POST['submit'])){
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$sex = $_POST['sex'];
	$numberGroup = $_POST['numberGroup'];
	$email = $_POST['email'];
	$score = $_POST['score'];
	$yearOfBirth = $_POST['yearOfBirth'];
	$location = $_POST['location'];
}


$pdo = new PDO('mysql:host=localhost;dbname=matriculant', DB_USER, DB_PASSWORD);


//Если пользователь не вошёл, то попытаемся войти
if (!isset($_COOKIE['id'])) {
	//проверка были ли переданы данные
	if (isset($_POST['submit'])){

		//Сохраняем в базу данных
		$stmt = $pdo->prepare("INSERT INTO matriculant (name, surname, sex, numberGroup, email, score, yearOfBirth, location)
			VALUES (:name, :surname, :sex, :numberGroup, :email, :score, :yearOfBirth, :location)");
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':surname', $surname);
			$stmt->bindParam(':sex', $sex);
			$stmt->bindParam(':numberGroup', $numberGroup);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':score', $score);
			$stmt->bindParam(':yearOfBirth', $yearOfBirth);
			$stmt->bindParam(':location', $location);
		$stmt->execute();
		$pdo = null;
		setcookie('id', $id, time() + (3600*24*365*10)); //срок действия чуть меньше 10 лет
		setcookie('name', $name, time() + (3600*24*365*10)); //срок действия чуть меньше 10 лет
	}
} else {
	if (isset($_POST['submit'])){
		

		$stmt = $pdo->prepare("UPDATE matriculant SET name=:name, surname=:surname, sex=:sex, 
			numberGroup=:numberGroup, email=:email, score=:score, yearOfBirth=:yearOfBirth, 
			location=:location WHERE id=:id");
			$stmt->bindParam(':id', $_COOKIE['id']);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':surname', $surname);
			$stmt->bindParam(':sex', $sex);
			$stmt->bindParam(':numberGroup', $numberGroup);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':score', $score);
			$stmt->bindParam(':yearOfBirth', $yearOfBirth);
			$stmt->bindParam(':location', $location);
		$stmt->execute();


		$pdo = null;
	} else {
		$stmt = $pdo->prepare("SELECT * FROM matriculant WHERE id=:id");
		$stmt->bindParam(':id', $_COOKIE['id']);
		$stmt->execute();
		$result = $stmt->fetch();

		$name = 		$result['name'];
		$surname = 		$result['surname'];
		$sex = 			$result['sex'];
		$numberGroup = 	$result['numberGroup'];
		$email = 		$result['email'];
		$score = 		$result['score'];
		$yearOfBirth = 	$result['yearOfBirth'];
		$location = 	$result['location'];
	}

}


include('profile.html');