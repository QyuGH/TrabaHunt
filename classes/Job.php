<?php 

class Job {
    private $jobId;
    private $jobTitle;
    private $skillsRequired;
    private $jobLocation;
    private $paymentAmount;
    private $jobDescription;
    private $datePosted;
    private $uploaderId;

    public function __construct($jobData){
        $this->jobId = uniqid("job_");
        $this->uploaderId = $jobData['uploaderId'];
        $this->jobTitle = $jobData['jobTitle'];
        $this->skillsRequired = $jobData['skills'];
        $this->jobLocation = $jobData['jobLocation'];
        $this->paymentAmount = $jobData['paymentAmount'];
        $this->jobDescription = $jobData['jobDescription'];
        $this->datePosted = date('Y-m-d H:i:s');
    }

    public function getJobData(){
        return $jobData = [
            "jobId" => $this->jobId,
            "uploaderId" => $this->uploaderId,
            "jobTitle" => $this->jobTitle,
            "skills" => $this->skillsRequired,
            "jobLocation" => $this->jobLocation,
            "paymentAmount" => $this->paymentAmount,
            "jobDescription" => $this->jobDescription,
            "datePosted" => $this->datePosted   
        ];
    }

    public function getJobId(){
        return $this->jobId;
    }
}

?>