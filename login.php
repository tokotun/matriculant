<?php
require_once 'app/boostrap.php';

    /*в getLoginData() Данные из $_POST и $_COOKIE записываются в массив$sentData 
      для последующей передачи в класс Matriculant */

$sentData = getLoginData();    
//если были получены ID и код, то подготавливаем обьект к обновлению
if (( $sentData['id'] <> '') and ($sentData['code'] <> '')) {   
    //считываем данные об абитуринте из базы
    $matriculant = $matriculantMapper->readMatriculant($sentData['id'], $sentData['code']);
    
    if (!$matriculant) {
        $matriculant = new Matriculant;  
    }
} else {
    $matriculant = new Matriculant;
}


if (isset($_POST['submit'])){
    $matriculant->setData($sentData);
    $matriculant->validateData();   

    if (!$matriculantMapper->checkUniquenessEmail($matriculant->email)) {
        $matriculant->setNotUniqueEmailError(); //не уникальный емайл, функция отмечает эту ошибку
    }

    if  ($matriculant->errors['error'] == false) {   
        if (($matriculant->id == '') && ($matriculant->code == '')) {
            //Cохраняем отправленные данные
            $matriculant->generateCode();
            $matriculantMapper->saveMatriculant($matriculant);
            setcookie('id', $matriculant->id, strtotime('+10 year'), null, null, false, true); //срок действия чуть меньше 10 лет
            setcookie('code', $matriculant->code, strtotime('+10 year'), null, null, false, true); //срок действия чуть меньше 10 лет 
            //при сохранении не совпадает токен и ID. Но выводить ошибку не требуется.
            header("Location: login.php?action=saved");
            die();
        } elseif (validateToken()) { 
            //Обновляем отправленные данные
            $matriculantMapper->updateMatriculant($matriculant);
            header("Location: login.php?action=update");
            die();    
        } else {
            $errorToken = 'Произошла ошибка. Пожалуйста, попробуйте отправить форму еще раз.';
        }
    }
}
include 'templates/profile.php'; 
