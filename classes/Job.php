<?php 

class Job {
    private $jobId;
    private $jobTitle;
    private $skills;
    private $jobLocation;
    private $paymentAmount;
    private $jobDescription;
    private $uploaderId;

    public function __construct($jobData){
        $this->jobId = uniqid("job_");
        $this->uploaderId = $jobData['uploaderId'];
        $this->jobTitle = $jobData['jobTitle'];
        $this->skills = $jobData['skills'];
        $this->jobLocation = $jobData['jobLocation'];
        $this->paymentAmount = $jobData['paymentAmount'];
        $this->jobDescription = $jobData['jobDescription'];
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

    public function getJobId(){
        return $this->jobId;
    }
}

?>