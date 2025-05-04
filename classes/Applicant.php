<?php 

require_once 'User.php';
class Applicant extends User{
    private $userId;
    private $skills;

    public function __construct($username = '', $email = '', $password = '', $user_type = '', $skills = ''){
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
            "user_type" => $this->userType
        ];
    }

    public function browseJobs() {
        $jobs_file = '../../data/jobs.json';
    
        if (!file_exists($jobs_file)) {
            echo "<div class='empty-state'>No jobs file found.</div>";
            return;
        }
    
        $jobs_data = file_get_contents($jobs_file);
        $jobs = array_reverse(json_decode($jobs_data, true));
    
        if (empty($jobs)) {
            echo "<div class='empty-state'>No jobs are available at the moment.</div>";
            return;
        }
    
        foreach ($jobs as $job) {
            echo "<div class='job-post'>";
            echo "<h3>" . htmlspecialchars($job['jobTitle']) . "</h3>";
            echo "<p><strong>Skills Required:</strong> " . htmlspecialchars($job['skills']) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($job['jobLocation']) . "</p>";
            echo "<p><strong>Payment:</strong> ₱" . htmlspecialchars($job['paymentAmount']) . "</p>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($job['jobDescription']) . "</p>";
            echo "<p><strong>Date Posted:</strong> " . htmlspecialchars($job['datePosted']) . "</p>";
            echo "<form method='POST' action='' style='text-align: right;'>";  // action to be implemented later
            echo "<input type='hidden' name='jobId' value='" . htmlspecialchars($job['jobId']) . "'>";
            echo "<button type='submit' class='upload-btn'>Apply</button>";
            echo "</form>";
            echo "</div>";
        }
    }

    public function getUserId(){
        return $this->userId;
    }

    public function updateProfile(){
        //function to add data for applicant profile
    }
}

?>