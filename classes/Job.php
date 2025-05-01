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

    public function saveJob($file){
        if (!file_exists($file)){
            file_put_contents($file, json_encode([]));
        }

        $data = json_decode(file_get_contents($file), true) ?? [];

        $jobData = [
            "jobId" => $this->jobId,
            "uploaderId" => $this->uploaderId,
            "jobTitle" => $this->jobTitle,
            "skills" => $this->skills,
            "jobLocation" => $this->jobLocation,
            "paymentAmount" => $this->paymentAmount,
            "jobDescription" => $this->jobDescription,
            "datePosted" => date('Y-m-d H:i:s')
        ];

        $data[] = $jobData; 

        $saved = file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

        return $saved !== false;
    }
}

?>