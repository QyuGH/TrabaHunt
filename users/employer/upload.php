<?php 

require_once '../../src/auth.php';
require_once '../../classes/Job.php';
$loggedUser = $_SESSION['user']['userId'];
$skills = [
    'Skilled Labor',
    'Household & Maintenance',
    'Construction & Physical Work',
    'Food & Event Services',
    'Personal Care',
    'Errand & Utility Services',
    'Others'
];

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $jobTitle = $_POST['job_title'];
    $skill = $_POST['skills_required'];
    $jobLocation = $_POST['job_location'];
    $paymentAmount = $_POST['payment_amount'];
    $jobDescription = $_POST['job_description'];

    $job = new Job($jobTitle, $skill, $jobLocation, $paymentAmount, $jobDescription, $loggedUser);

    $file = '../../data/jobs.json';

    $saveResult = $job->saveJob($file);

    if ($saveResult){
        header("Location: home.php");
        exit();
    }
    else {
        $error = $saveResult;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Job</title>
    <link rel="stylesheet" href="designs/upload.css">
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="nav-links">
                <a href="home.php" class="nav-item">Home</a>
                <a href="profile.php" class="nav-item">Profile</a>
                <a href="notifications.php" class="nav-item">Notifications</a>
                <a href="upload.php" class="nav-item active upload-btn">Upload Post</a>
            </div>
        </nav>

        <!-- Upload Job Form Section -->
        <section class="form-section">
            <h2 class="section-header">Post a New Job</h2>
            
            <form method="POST">
                <!-- Job Title -->
                <div class="form-group">
                    <label for="job_title" class="form-label">Job Title <span class="required">*</span></label>
                    <input type="text" id="job_title" name="job_title" class="form-input" required>
                </div>
                
                <!-- Skills Required -->
                <div class="form-group">
                    <label for="skills_required" class="form-label">Skills Required <span class="required">*</span></label>
                    <select id="skills_required" name="skills_required" class="form-select" required>
                        <option value="">Select Required Skills</option>
                        <?php foreach ($skills as $skill): ?>
                            <option value="<?= htmlspecialchars($skill) ?>"><?= htmlspecialchars($skill) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Job Location -->
                <div class="form-group">
                    <label for="job_location" class="form-label">Job Location <span class="required">*</span></label>
                    <input type="text" id="job_location" name="job_location" class="form-input" placeholder="City, State or Remote" required>
                </div>
                
                <!-- Payment Amount -->
                <div class="form-group">
                    <label for="payment_amount" class="form-label">Payment Amount <span class="required">*</span></label>
                    <input type="text" id="payment_amount" name="payment_amount" class="form-input" placeholder="e.g. ₱500 - ₱5,000" required>
                </div>
                
                <!-- Job Description -->
                <div class="form-group">
                    <label for="job_description" class="form-label">Job Description <span class="required">*</span></label>
                    <textarea id="job_description" name="job_description" class="form-textarea" placeholder="Provide a detailed description of the job responsibilities, requirements, and benefits..." required></textarea>
                </div>
                
                <!-- Form Footer -->
                <div class="form-footer">
                    <button class="submit-btn cancel" onclick="window.location.href='home.php';">Cancel</button>
                    <button type="submit" class="submit-btn post">Post Job</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>