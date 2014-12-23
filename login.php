<?php
include('connectvars.php');
include('dataMapper.php');

$matriculant = new Matriculant;
if (isset($_COOKIE['id'])) $matriculant->id = $_COOKIE['id'];
if (isset($_POST['submit'])){
	$matriculant->name = $_POST['name'];
	$matriculant->surname = $_POST['surname'];
	$matriculant->sex = $_POST['sex'];
	$matriculant->numberGroup = $_POST['numberGroup'];
	$matriculant->email = $_POST['email'];
	$matriculant->score = $_POST['score'];
	$matriculant->yearOfBirth = $_POST['yearOfBirth'];
	$matriculant->location = $_POST['location'];
}



$pdo = new PDO('mysql:host=localhost;dbname=matriculant', DB_USER, DB_PASSWORD);
$matriculantMapper = new MatriculantMapper($pdo);
$pdo = null;

if (isset($_POST['submit'])){
	//Обновляем в базу данных
	$matriculantMapper->saveMatriculant($matriculant);
} else {
	$matriculantMapper->viewMatriculant($matriculant);
}

	//Эти переменные используются в шаблоне
 	if (isset($matriculant->id)) $id = $matriculant->name;
	$name = 		$matriculant->name;
	$surname = 		$matriculant->surname;
	$sex = 			$matriculant->sex;
	$numberGroup = 	$matriculant->numberGroup;
	$email = 		$matriculant->email;
	$score = 		$matriculant->score;
	$yearOfBirth = 	$matriculant->yearOfBirth;
	$location = 	$matriculant->location;

include('profile.html');