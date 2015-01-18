<?php
    $sentData = array();
    //данные из кук
    if (isset($_COOKIE['id'])) {
        $sentData['id'] = $_COOKIE['id'];
    }else{
        $sentData['id'] = '';
    }

    if (isset($_COOKIE['code'])) {
        $sentData['code'] = $_COOKIE['code'];
    }else{
        $sentData['code'] = '';
    }

    //данные из пост
    $nameField = array('name','surname','sex','numberGroup','email','score','yearOfBirth','location');


    foreach ($nameField as $value)
    {
        if (isset($_POST[$value])) 
        { 
            $sentData[$value] = $_POST[$value];
        } 
        else 
        {
            $sentData[$value] = '';
        }
    }