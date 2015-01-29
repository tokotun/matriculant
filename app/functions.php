<?php

function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES);
}

function getLoginData(){
	$sentData = array();
    //данные из кук
    (isset($_COOKIE['id'])) ? $sentData['id'] = $_COOKIE['id'] : $sentData['id'] = '';

    (isset($_COOKIE['code'])) ? $sentData['code'] = $_COOKIE['code'] : $sentData['code'] = '';
    
    //данные из пост
    $nameField = array('name','surname','sex','numberGroup','email','score','yearOfBirth','location');


    foreach ($nameField as $value)
    {
        (isset($_POST[$value])) ? $sentData[$value] = trim($_POST[$value]) : $sentData[$value] = '';
    }
    return $sentData;

}

function validateToken(){

   
	if ((isset($_COOKIE['code'])) and (isset($_POST['token']))){
        $code = $_COOKIE['code'];
    	$token = $_POST['token'];

    	if ($code == $token)  return TRUE;
    }
    return FALSE;
}

