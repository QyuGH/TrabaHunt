<?php 

require_once 'User.php';
class Applicant extends User{
    private $userId;
    private $skills;

    public function __construct($username, $email, $password, $user_type, $skills){
        parent::__construct($username, $email, $password, $user_type);
        $this->userId = uniqid("applicant_");
        $this->skills = $skills;
    }

    public function getApplicantData(){
        return $applicantData = [
            "userId" => $this->userId,
            "username" => $this->username,
            "skills" => $this->skills,
            "email" => $this->email,
            "password" => $this->password,
            "user_type" => $this->user_type
        ];
    }
}

?>