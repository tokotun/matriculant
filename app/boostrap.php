<?php
	$dbc = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
	$pdo = new PDO($dbc, $db_user, $db_password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$matriculantMapper = new MatriculantMapper($pdo);