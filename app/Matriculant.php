<?php

class Matriculant
{
    public $errors = array(
        'error' => false,
        'name' => '',
        'surname' => '',
        'numberGroup' => '',
        'email' => '',
        'score' => '',
        'yearOfBirth' => '');
    public $id;
    public $code;
    public $name;
    public $surname;
    public $sex;
    public $numberGroup;
    public $email;
    public $score;
    public $yearOfBirth;
    public $location;

    public function readPost()
    {   
      //получает данные об абитуриентах от формы
        $this->getName($_POST['name']);
        $this->getSurname($_POST['surname']);
        $this->sex = $_POST['sex'];
        $this->getNumberGroup($_POST['numberGroup']);
        $this->getEmail($_POST['email']);
        $this->getScore($_POST['score']);
        $this->getYearOfBirth($_POST['yearOfBirth']);
        $this->location = $_POST['location'];
    }


    //далее идут всякие функции проверяющие адекватность введённых данных
    public function getName($name)
    {   
        $name = trim($name);
        $regexp = '/^[А-ЯЁ][а-яё]{1,80}$/u';
        if (preg_match($regexp, $name)) {
            $this->name = $name;
        } else {
            $this->errors['error'] = true;
            $this->errors['name']  = 'Неправильно введено имя';
        }
    }

    public function getSurname($surname)
    {   
        $surname = trim($surname);
        $regexp = '/^[А-ЯЁ][а-яё]{1,50}(-[А-ЯЁ][а-яё]{1,50})?$/u'; //проверка на двойную фамилию тоже
        if (preg_match($regexp, $surname)) {
            $this->surname = $surname;
        } else {
            $this->errors['error'] = true;
            $this->errors['surname']  = 'Неправильно введена фамилия';
        }
    }

    public function getNumberGroup($numberGroup)
    {   
        $numberGroup = trim($numberGroup);
        $regexp = '/^[0-9А-ЯЁ-]{4,5}$/u';
        if (preg_match($regexp, $numberGroup)) {
            $this->numberGroup = $numberGroup;
        } else {
            $this->errors['error'] = true;
            $this->errors['numberGroup']  = 'Неправильно введен номер группы';
        }
    }

    public function getEmail($email)
    {   
        $email = trim($email);
        $regexp = '/.+@.+\..+/i';

        //тут надо будет проверить емэйл на уникальность

        if (preg_match($regexp, $email)) {
            $this->email = $email;
        } else {
            $this->errors['error'] = true;
            $this->errors['email']  = 'Неправильный формат email адреса';
        }
    }

    public function getScore($score)
    {   
        if (($score >= 0) && ($score <= 300)) {
            $this->score = $score;
        } else {
            $this->errors['error'] = true;
            $this->errors['score'] = 'Баллов не должно быть меньше 0 и больше 300';
        }
    }

    public function getYearOfBirth($yearOfBirth)
    {   
        $yearOfBirth = trim($yearOfBirth);
        $regexp = '/^[0-9]{4}?$/u'; //формат даты 19хх
        if (preg_match($regexp, $yearOfBirth)) {
            $this->yearOfBirth = $yearOfBirth;
        } else {
            $this->errors['error'] = true;
            $this->errors['yearOfBirth'] = 'Формат даты для ввода должен быть - хххх';
        }
    }
    
}