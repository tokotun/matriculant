<?php

function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES);
}

function getLoginData(){
	$sentData = array();
    //данные из кук
    $sentData['id'] =   (isset($_COOKIE['id']))   ? $_COOKIE['id']   : '';

    $sentData['code'] = (isset($_COOKIE['code'])) ? $_COOKIE['code'] : '';
    
    //данные из пост
    $nameField = array('name','surname','sex','numberGroup','email','score','yearOfBirth','location');


    foreach ($nameField as $value)
    {
        $sentData[$value] = (isset($_POST[$value])) ? trim($_POST[$value]) : '';
    }
    return $sentData;

}

function validateToken(){

	if ((isset($_COOKIE['code'])) and (isset($_POST['token']))){
        $code = $_COOKIE['code'];
    	$token = $_POST['token'];

    	if ($code == $token)  {
            return true;
        }
    }
    return false;
}
