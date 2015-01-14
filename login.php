<?php
include('config.php');
include('app/autoloader.php');
spl_autoload_register('autoloader');

$matriculant = new Matriculant;

$title = "Регистрация абитуриента";         //Переменная для шаблона 'templates/profile.php'
if (isset($_COOKIE['id'])) {
    $matriculant->id = $_COOKIE['id'];
    $title = "Редактирование данных об абитуриенте";  //Переменная для шаблона 'templates/profile.php'
}
if (isset($_COOKIE['code'])) {
    $matriculant->code = $_COOKIE['code'];
}
if (isset($_POST['submit'])){
    $matriculant->readPost(); //присваивает в $matriculant значения переданные из $_POST
}

$dbc = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
$pdo = new PDO($dbc, $db_user, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$matriculantMapper = new MatriculantMapper($pdo);
$pdo = null;

// вывод записи из базы данных или обновление записи в базе данных.
if (($matriculant->errors['error'] == false) && (isset($matriculant->id)) && (isset($matriculant->code))){
    //Обновляем в базу данных
    if (isset($_POST['submit'])){ 
        $matriculantMapper->updateMatriculant($matriculant);
    } 
    else {
        $matriculantMapper->readMatriculant($matriculant);
    }
} else {
    //сохраняем отправленные данные
    if (isset($_POST['submit'])){
        $matriculantMapper->saveMatriculant($matriculant);
        setcookie('id', $matriculant->id, strtotime('+10 year'), null, null, false, true); //срок действия чуть меньше 10 лет
        setcookie('code', $matriculant->code, strtotime('+10 year'), null, null, false, true); //срок действия чуть меньше 10 лет
    }
}

    //Эти переменные используются в шаблоне.
    $name =         htmlspecialchars($matriculant->name);
    $surname =      htmlspecialchars($matriculant->surname);
    $sex =          $matriculant->sex;
    $numberGroup =  htmlspecialchars($matriculant->numberGroup);
    $email =        htmlspecialchars($matriculant->email);
    $score =        htmlspecialchars($matriculant->score);
    $yearOfBirth =  htmlspecialchars($matriculant->yearOfBirth);
    $location =     $matriculant->location;
    $errors =       $matriculant->errors;
    

include('templates/profile.php');