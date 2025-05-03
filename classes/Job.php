<?php 

class Job {
    private $jobId;
    private $jobTitle;
    private $skills;
    private $jobLocation;
    private $paymentAmount;
    private $jobDescription;
    private $uploaderId;

    public function __construct($jobTitle, $skills, $jobLocation, $paymentAmount, $jobDescription, $uploaderId){
        $this->jobId = uniqid("job_");
        $this->jobTitle = $jobTitle;
        $this->skills = $skills;
        $this->jobLocation = $jobLocation;
        $this->paymentAmount = $paymentAmount;
        $this->jobDescription = $jobDescription;
        $this->uploaderId = $uploaderId;
    }

    public function getJobData(){
        return $jobData = [
            "jobId" => $this->jobId,
            "uploaderId" => $this->uploaderId,
            "jobTitle" => $this->jobTitle,
            "skills" => $this->skills,
            "jobLocation" => $this->jobLocation,
            "paymentAmount" => $this->paymentAmount,
            "jobDescription" => $this->jobDescription,
            "datePosted" => date('Y-m-d H:i:s')
        ];
    }
}

?>