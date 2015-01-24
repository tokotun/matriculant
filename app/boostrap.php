<?php
	require_once 'config.php';
	require_once 'app/functions.php';
	require_once 'app/autoloader.php';
	spl_autoload_register('autoloader');

	$errorToken = '';
	$dbc = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
	$pdo = new PDO($dbc, $db_user, $db_password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$matriculantMapper = new MatriculantMapper($pdo);