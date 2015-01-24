<?php
	error_reporting(-1);
    // Define database connection constants
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_name = 'matriculant';
    $resultPerPage = 5;   //колличество абитуринтов на 1 странице
    $columns = array(       //определяет какие колонки необходимо выводить
    		'name' 			=> 'First Name',
    		'surname'		=> 'Last Name',
    		//'sex' 			=> 'SEX',
    		'numberGroup'	=> 'Number Group',
    		//'email'			=> 'E-Mail',
    		'score'			=> 'Score',
    		//'yearOfBirth'	=> 'Year Of Birth', 
    		//'location'		=> 'The Place Of Residence',
    );
