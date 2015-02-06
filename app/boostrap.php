<?php
    require 'config.php';
    require_once 'app/functions.php';
    require_once 'app/autoloader.php';
    spl_autoload_register('autoloader');

    $errorToken = '';
    $dbc = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
    $pdo = new PDO($dbc, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $matriculantMapper = new MatriculantMapper($pdo);

    $id   = (isset($_COOKIE['id']))   ? $_COOKIE['id']   : '';
    $code = (isset($_COOKIE['code'])) ? $_COOKIE['code'] : '';

    //проверка на наличие в базе абитуриента с таким ID
    $loggedIn = $matriculantMapper->isLoggedIn($id, $code);

    //определение раздела
    $section = '';
    if ($_SERVER['PHP_SELF'] == '/matriculant/index.php'){
        $section = 'index';
    }
    if ($_SERVER['PHP_SELF'] == '/matriculant/login.php'){
        $section = 'login';
    }

