<?php 

require_once 'User.php';
require_once 'Job.php';
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

    public function postJob(Job $job, $file){
        if (!file_exists($file)){
            file_put_contents($file, json_encode([]));
        }

        $data = json_decode(file_get_contents($file), true) ?? [];

        $jobData = $job->getJobData();

        $data[] = $jobData; 

        $saved = file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

        return $saved !== false;
    }
}

?>