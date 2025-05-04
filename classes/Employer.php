<?php 

require_once 'User.php';
require_once 'Job.php';
class Employer extends User{
    private $userId;
    private $businessName;
    private $job;

    public function __construct($username = '', $email = '', $password = '', $user_type = '', $businessName = ''){
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
            "user_type" => $this->userType
        ];
    }

    public function postJob($jobData, $file){
        $job = new Job($jobData);

        if (!file_exists($file)){
            file_put_contents($file, json_encode([]));
        }

        $data = json_decode(file_get_contents($file), true) ?? [];

        $data[] = $job->getJobData(); 

        $saved = file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

        return $saved !== false;
    }

    public function displayPostedJobs($jobs_file, $id) {
        $loggedUser = $id; //Assigns the id of the currently logged user
    
        if (!file_exists($jobs_file)) {
            echo '<div class="empty-state">No jobs have been posted yet.</div>';
            return;
        }
    
        $jobs_data = file_get_contents($jobs_file);
        $jobs = json_decode($jobs_data, true);
    
        if (empty($jobs)) {
            echo '<div class="empty-state">No jobs have been posted yet.</div>';
            return;
        }
    
        $user_jobs = [];

        foreach ($jobs as $job) {
            if ($job['uploaderId'] === $loggedUser) {
                $user_jobs[] = $job;
            }
        }

        $user_jobs = array_reverse($user_jobs); 

    
        if (empty($user_jobs)) {
            echo '<div class="empty-state">No jobs have been posted yet.</div>';
            return;
        }
    
        foreach ($user_jobs as $job) {
            echo "<div class='job-post'>";
            echo "<h3>" . htmlspecialchars($job['jobTitle']) . "</h3>";
            echo "<p><strong>Skills Required:</strong> " . htmlspecialchars($job['skills']) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($job['jobLocation']) . "</p>";
            echo "<p><strong>Payment:</strong> ₱" . htmlspecialchars($job['paymentAmount']) . "</p>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($job['jobDescription']) . "</p>";
            echo "<p><strong>Date Posted:</strong> " . htmlspecialchars($job['datePosted']) . "</p>";
            echo "<form action='' method='GET'>"; // action to be implemented later
            echo "<input type='hidden' name='jobId' value='" . htmlspecialchars($job['jobId']) . "'>";
            echo "<button type='submit' class='view-btn'>View Applicants</button>";
            echo "</form>";
            echo "</div>";
        }
    }
    
    public function updateProfile(){
        //function to add data for employer profile
    }

    public function getUserId(){
        return $this->userId;
    }
}

?>