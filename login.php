<?php
include 'config.php';
include 'app/functions.php';
include 'app/autoloader.php';
spl_autoload_register('autoloader');

$matriculant = new Matriculant;

    /*в 'app/getLoginData.php'. Данные из $_POST и $_COOKIE записываются в $sentData 
      для последующей передачи в класс Matriculant */
include 'app/getLoginData.php';                  
    //тут вышел массив $sentData

$matriculant->setData($sentData);
if (isset($_POST['submit'])){
     //присваивает в $matriculant значения переданные из $sentData
    $matriculant->validateData();
}

require_once('app/boostrap.php');

//проверка емайла на уникальность
if ($matriculant->errors['error'] == false){
    if (!$matriculantMapper->checkUniquenessEmail($matriculant->email)){
        $matriculant->setNotUniqueEmailError(); //не уникальный емайл, функция отмечает эту ошибку
    }
}

// вывод записи из базы данных или обновление записи в базе данных.
//Лесницу из условий нагородил      =(
if  ((isset($_POST['submit'])) and               //для обновления нужено нахатие на кнопку...
    ($matriculant->errors['touken'] == '')){     //... и токен соответствующий ключу

    if ($matriculant->errors['error'] == false) {        
        if (($matriculant->id <> '') && ($matriculant->code <> ''))        
        {       //Обновляем в базу данных
            $matriculantMapper->updateMatriculant($matriculant);
        }else{  //сохраняем отправленные данные
            $matriculant->generateCode();
            $matriculantMapper->saveMatriculant($matriculant);
            setcookie('id', $matriculant->id, strtotime('+10 year'), null, null, false, true); //срок действия чуть меньше 10 лет
            setcookie('code', $matriculant->code, strtotime('+10 year'), null, null, false, true); //срок действия чуть меньше 10 лет
        }
    }
}else{
    $matriculantMapper->readMatriculant($matriculant);
    if  (!isset($_POST['submit']))    $matriculant->errors['touken'] = '';                        
}
include 'templates/profile.php';