<?php

class Matriculant
{
    public $errors = array(
        'error' => false,
        'name' => '',
        'surname' => '',
        'sex' => '',
        'numberGroup' => '',
        'email' => '',
        'score' => '',
        'yearOfBirth' => '',
        'location' => '');
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

    public function setData($sentData)
    {   
      //получает данные об абитуриентах от формы
        $this->setId($sentData['id']);
        $this->setCode($sentData['code']);
        $this->setName($sentData['name']);
        $this->setSurname($sentData['surname']);
        $this->setSex($sentData['sex']);
        $this->setNumberGroup($sentData['numberGroup']);
        $this->setEmail($sentData['email']);
        $this->setScore($sentData['score']);
        $this->setYearOfBirth($sentData['yearOfBirth']);
        $this->setLocation($sentData['location']);
    }

    public function validateData(){
        $this->validateName();
        $this->validateSurname();
        $this->validateSex();
        $this->validateNumberGroup();
        $this->validateEmail();
        $this->validateScore();
        $this->validateYearOfBirth();
        $this->validateLocation();
    }

    protected function setId($id){ 
        $this->id = $id;
    }

    protected function setCode($code){ 
        $this->code = $code;
    }
    public function generateCode(){ 
        $this->code = mt_rand ( 10000 , 99999 ) . mt_rand ( 10000 , 99999 ) . mt_rand ( 10000 , 99999 );
    }


    //далее идут всякие функции проверяющие адекватность введённых данных
    protected function setName($name){ 
        $name = trim($name);
        $this->name = $name;
    }
    protected function validateName(){ 
        $regexp = '/^[А-ЯЁ][а-яё]{1,80}$/u';
        if (!preg_match($regexp, $this->name)) {
            $this->errors['error'] = true;
            $this->errors['name']  = 'Неверно введено имя';
        }
    }

    protected function setSurname($surname){
        $surname = trim($surname);
        $this->surname = $surname;   
    }
    protected function validateSurname(){
        $regexp = '/^[А-ЯЁ][а-яё]{1,50}(-[А-ЯЁ][а-яё]{1,50})?$/u'; //проверка на двойную фамилию тоже
        if (!preg_match($regexp, $this->surname)) 
        {
            $this->errors['error'] = true;
            $this->errors['surname']  = 'Неправильно введена фамилия';
        }
    }

    protected function setSex($sex){
        $this->sex = $sex;  
    }
    protected function validateSex(){
        if ($this->sex == '') {
            $this->errors['error'] = true;
            $this->errors['sex']  = 'Не отмечен пол студента';
        }
    }

    protected function setNumberGroup($numberGroup){
        $numberGroup = trim($numberGroup);
        $this->numberGroup = $numberGroup;  
    }
    protected function validateNumberGroup(){
        $regexp = '/^[0-9А-ЯЁ-]{4,5}$/u';
        if (!preg_match($regexp, $this->numberGroup)) {
            $this->errors['error'] = true;
            $this->errors['numberGroup']  = 'Неверно введен номер группы';
        }
    }

    protected function setEmail($email){   
        $email = trim($email);
        $this->email = $email;
    }
    protected function validateEmail(){
        $regexp = '/.+@.+\..+/i';
        if (!preg_match($regexp, $this->email)) {
            $this->errors['error'] = true;
            $this->errors['email']  = 'Неверный формат email адреса';
        }
    }

    protected function setScore($score)
    {   
        $this->score = $score;   
    }
    protected function validateScore(){
        if (($this->score < 0) && ($this->score > 300)) {
            $this->errors['error'] = true;
            $this->errors['score'] = 'Баллов не должно быть меньше 0 и больше 300';
        }
    }

    protected function setYearOfBirth($yearOfBirth){   
        $yearOfBirth = trim($yearOfBirth);
        $this->yearOfBirth = $yearOfBirth;
    }
    protected function validateYearOfBirth(){
        $regexp = '/^[0-9]{4}?$/u'; //формат даты 19хх
        if (!preg_match($regexp, $this->yearOfBirth)) {
            $this->errors['error'] = true;
            $this->errors['yearOfBirth'] = 'Формат даты для ввода должен быть - хххх';
        }
    }

    protected function setLocation($location)
    {
        $this->location = $location;
        
    }
    protected function validateLocation(){
       if ($this->location == '') {    
            $this->errors['error'] = true;
            $this->errors['location']  = 'Не отмечено место проживания студента';
        } 
    }
    
    public function setNotUniqueEmailError()
    {
        $this->errors['error'] = true;
        $this->errors['email']  = 'email адрес уже занят';
    }

}