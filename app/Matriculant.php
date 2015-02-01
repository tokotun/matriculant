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
    public $id = '';
    public $code = '';
    public $name = '';
    public $surname = '';
    public $sex = '';
    public $numberGroup = '';
    public $email = '';
    public $score = '';
    public $yearOfBirth = '';
    public $location = '';

    public function hasError()
    {
        return $this->errors['error'];
    }

    public function setData($sentData)
    {   
      //получает данные об абитуриентах от формы
        if ($sentData['id'] <> '')          $this->setId($sentData['id']);
        if ($sentData['code'] <> '')        $this->setCode($sentData['code']);
        if ($sentData['name'] <> '')        $this->setName($sentData['name']);
        if ($sentData['surname'] <> '')     $this->setSurname($sentData['surname']);
        if ($sentData['sex'] <> '')         $this->setSex($sentData['sex']);
        if ($sentData['numberGroup'] <> '') $this->setNumberGroup($sentData['numberGroup']);
        if ($sentData['email'] <> '')       $this->setEmail($sentData['email']);
        if ($sentData['score'] <> '')       $this->setScore($sentData['score']);
        if ($sentData['yearOfBirth'] <> '') $this->setYearOfBirth($sentData['yearOfBirth']);
        if ($sentData['location'] <> '')    $this->setLocation($sentData['location']);
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
        $this->code ='';
        $string = "abcdefghijklmnopqrstuvwxyz1234567890";
        $length = mb_strlen($string);

        for ($i=0; $i < 16 ; $i++) { 
            $char = mb_substr($string, mt_rand(0,$length-1),1);
            $this->code.= $char;
         }
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
        if ($this->name =='') $this->errors['name']  = 'Необходимо заполнить это поле';
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
        if ($this->surname =='') $this->errors['surname']  = 'Необходимо заполнить это поле';
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
        if ($this->numberGroup =='') $this->errors['numberGroup']  = 'Необходимо заполнить это поле';
    }

    protected function setEmail($email){   
        $email = trim($email);
        $this->email = $email;
    }
    protected function validateEmail(){
        $regexp = "/^[^ ]+@[^ ]+\.[^ ]+$/i";

        if (!preg_match($regexp, $this->email)) {
            $this->errors['error'] = true;
            $this->errors['email']  = 'Неверный формат email адреса';
        }
        if ($this->email =='') $this->errors['email']  = 'Необходимо заполнить это поле';
    }

    protected function setScore($score)
    {   
        
        $this->score = $score;   
    }
    protected function validateScore(){
        
        if (($this->score < 0) or ($this->score > 300) or ($this->score == '')) { 
            $this->errors['error'] = true;
            $this->errors['score'] = 'Баллов не должно быть меньше 0 и больше 300';
        }
        if ($this->score =='') $this->errors['score']  = 'Необходимо заполнить это поле';
    }

    protected function setYearOfBirth($yearOfBirth){   
        $yearOfBirth = trim($yearOfBirth);
        $this->yearOfBirth = $yearOfBirth;
    }
    protected function validateYearOfBirth(){
        $regexp = '/^[0-9]{4}?$/u'; //формат даты 19хх
        if ((!preg_match($regexp, $this->yearOfBirth)) 
            or ($this->yearOfBirth < 1900) or ($this->yearOfBirth > 2050)) {
            $this->errors['error'] = true;
            $this->errors['yearOfBirth'] = 'Формат даты для ввода должен быть - хххх';
        }
        if ($this->yearOfBirth =='') $this->errors['yearOfBirth']  = 'Необходимо заполнить это поле';
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