<?php 

require_once 'User.php';
class Employer extends User{
    private $userId;
    private $businessName;

    public function __construct($username, $email, $password, $user_type, $businessName){
        parent::__construct($username, $email, $password, $user_type);
        $this->userId = uniqid("employer_");
        $this->businessName = $businessName;
    }

    public function getEmployerData(){
        return $employerData = [
            "userId" => $this->userId,
            "username" => $this->username,
            "businessName" => $this->businessName,
            "email" => $this->email,
            "password" => $this->password,
            "user_type" => $this->user_type
        ];
    }

    public function postJob(){
        //logic to be implemented later
    }
}

?>