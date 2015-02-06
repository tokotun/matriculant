<?php
require_once 'app/boostrap.php';

/**
 * В getLoginData() Данные из $_POST и $_COOKIE записываются в массив$sentData 
 * для последующей передачи в класс Matriculant 
 */
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
    $matriculant->validateData($matriculantMapper);   

    if (!$matriculantMapper->checkUniquenessEmail($matriculant)) {
        $matriculant->setNotUniqueEmailError(); //не уникальный емайл, функция отмечает эту ошибку
    }

    if  (!$matriculant->getError()) {   
        if (($matriculant->getId() == '') && ($matriculant->getCode() == '')) {
            //Cохраняем отправленные данные
            $matriculant->generateCode();
            $matriculantMapper->saveMatriculant($matriculant);
            setcookie('id', $matriculant->getId(), strtotime('+10 year'), '/', null, false, true); //срок действия чуть меньше 10 лет
            setcookie('code', $matriculant->getCode(), strtotime('+10 year'), '/', null, false, true); //срок действия чуть меньше 10 лет 
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
/* $action - это действие, которое произошло (save/update)
*/
$action = '';
if (isset($_GET['action'])){
    if ($_GET['action'] == 'update'){
        $action = 'Изменения сохранены';
    }
    if ($_GET['action'] == 'save'){
        $action = 'Вы успешно зарегистрировались и добавлены в таблицу';
    }
}

include 'templates/profile.php'; 
