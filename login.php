<?php
require_once 'app/boostrap.php';

$matriculant = new Matriculant;

    /*в getLoginData() Данные из $_POST и $_COOKIE записываются в массив$sentData 
      для последующей передачи в класс Matriculant */
$sentData = getLoginData();    
//если были получены ID и код, то подготавливаем обьект к обновлению
if (( $sentData['id'] <> '') and ($sentData['code'] <> '')){
    //считываем данные об абитуринте из базы
    $result = $matriculantMapper->readMatriculant($sentData['id'], $sentData['code']);
    //заносим эти данные в обьект
    $matriculant->setResult($result);
    //перезаписываем данными отправленными формой
    $matriculant->rewriteMatriculant($sentData);
} else {
    $matriculant->setData($sentData);  
}
    


if (isset($_POST['submit'])){
     //присваивает в $matriculant значения переданные из $sentData
    $matriculant->validateData();   
}
//проверка емайла на уникальность
if ($matriculant->errors['error'] == false){
    if (!$matriculantMapper->checkUniquenessEmail($matriculant->email)){
        $matriculant->setNotUniqueEmailError(); //не уникальный емайл, функция отмечает эту ошибку
    }
}


//Лесницу из условий нагородил      =(

if  (isset($_POST['submit'])){   

    //Обновляем в базу данных если токен валиден
    if (validateToken()) {      
        $matriculantMapper->updateMatriculant($matriculant);
    } elseif ($matriculant->errors['error'] == false) { //если не произошло обновление то пытаемся сохранить.
        //Cохраняем отправленные данные
        if (($matriculant->id == '') && ($matriculant->code == '')){  
            $matriculant->generateCode();
            $matriculantMapper->saveMatriculant($matriculant);
            setcookie('id', $matriculant->id, strtotime('+10 year'), null, null, false, true); //срок действия чуть меньше 10 лет
            setcookie('code', $matriculant->code, strtotime('+10 year'), null, null, false, true); //срок действия чуть меньше 10 лет    
        }   
    } else { //если не произошло ни обновление ни  сохранение, то отправляем ошибку
        $errorToken = 'Произошла ошибка. Пожалуйста, попробуйте отправить форму еще раз.';
    }
}else{
    $result = $matriculantMapper->readMatriculant($sentData['id'], $sentData['code']);
    if (!isset($result)) $matriculant->setResult($result);                        
}

include 'templates/profile.php';