<?php
error_reporting(-1);
include('config.php');
include('app/Matriculant.php');
include('app/MatriculantMapper.php');

$matriculant = new Matriculant;

if (isset($_COOKIE['id'])) {
    $matriculant->id = $_COOKIE['id'];
}



if (isset($_POST['submit'])){
    /*
    $matriculant->name = $_POST['name'];
    $matriculant->surname = $_POST['surname'];
    $matriculant->sex = $_POST['sex'];
    $matriculant->numberGroup = $_POST['numberGroup'];
    $matriculant->email = $_POST['email'];
    $matriculant->score = $_POST['score'];
    $matriculant->yearOfBirth = $_POST['yearOfBirth'];
    $matriculant->location = $_POST['location'];
    */
    $matriculant->readPost(); //присваивает значения переданные из $_POST
}


$dbc = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
$pdo = new PDO($dbc, $db_user, $db_password);
$matriculantMapper = new MatriculantMapper($pdo);
$pdo = null;

if (isset($_POST['submit']) && ($matriculant->errors['error'] == false)){
    //Обновляем в базу данных
    $matriculantMapper->saveMatriculant($matriculant);
    setcookie('id', $matriculant->id, strtotime('+10 year'), null, null, false, true); //срок действия чуть меньше 10 лет
} else {
    if (isset($matriculant->id)) $matriculantMapper->readMatriculant($matriculant);
}

    //Эти переменные используются в шаблоне

    $name =         $matriculant->name;
    $surname =      $matriculant->surname;
    $sex =          $matriculant->sex;
    $numberGroup =  $matriculant->numberGroup;
    $email =        $matriculant->email;
    $score =        $matriculant->score;
    $yearOfBirth =  $matriculant->yearOfBirth;
    $location =     $matriculant->location;
    $errors =       $matriculant->errors;

include('templates/profile.php');