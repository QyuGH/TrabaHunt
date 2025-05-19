<?php 

require_once '../../src/auth.php';
require_once '../../classes/Job.php';
require_once '../../classes/Employer.php';

$loggedUser = $_SESSION['user']['userId'];
$skills = [
    'Housekeeping (e.g., General Cleaning, Organizing Rooms)',
    'Laundry Services (e.g., Handwashing Clothes, Ironing)',
    'Childcare Assistance (e.g., Babysitting, Feeding Toddlers)',
    'Elderly Care (e.g., Assisting Mobility, Medication Reminders)',
    'Gardening (e.g., Grass Trimming, Plant Maintenance)',
    'Pet Care (e.g., Dog Walking, Bathing Pets)',
    'Haircutting (e.g., Basic Haircut)',
    'Shoe Repair (e.g., Sole Replacement, Stitching)',
    'Event Decorating (e.g., Table Setup, Event Arrangements)',
    'Delivery Services (e.g., Parcel Pickup, Water Gallon Delivery)',
    'Electrical Works (e.g., House Wiring, Lighting Installation)',
    'Plumbing (e.g., Pipe Repair, Faucet Installation)',
    'Carpentry (e.g., Door Repair, Cabinet Making)',
    'Construction (e.g., Wall Patching, Cement Mixing)',
    'Welding (e.g., Gate Repair, Steel Window Fabrication)',
    'Motorcycle Repair (e.g., Change Oil, Brake Adjustment)',
    'Appliance Servicing (e.g., Electric Fan Repair, Aircon Cleaning)',
    'Others'
];

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $jobTitle = $_POST['job_title'] ?? '';
    $skill = $_POST['skills_required'] ?? '';
    $jobLocation = $_POST['job_location'] ?? '';
    $paymentAmount = $_POST['payment_amount'] ?? '';
    $jobDescription = $_POST['job_description'] ?? '';

    $jobData = [
        "uploaderId" => $loggedUser,
        "jobTitle" => $jobTitle,
        "skills" => $skill,
        "jobLocation" => $jobLocation,
        "paymentAmount" => $paymentAmount,
        "jobDescription" => $jobDescription,
    ];
        
    $file = '../../data/jobs.json';

    $employer = new Employer();

    $postResult = $employer->postJob($jobData, $file);

    if ($postResult){
        header("Location: home.php");
        exit();
    }
    else {
        $error = $postResult;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Job</title>
    <link rel="stylesheet" href="../../css/navigations.css">
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
            </div>
        </nav>

        <!-- Upload Job Form Section -->
        <section class="form-section">
            <h2 class="section-header">Post a New Job</h2>
            
            <form method="POST">
                <div class="form-group">
                    <label for="job_title" class="form-label">Job Title <span class="required">*</span></label>
                    <input type="text" id="job_title" name="job_title" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="skills_required" class="form-label">Skills Required <span class="required">*</span></label>
                    <select id="skills_required" name="skills_required" class="form-select" required>
                        <option value="">Select Required Expertise</option>
                        <?php foreach ($skills as $skill): ?>
                            <option value="<?= htmlspecialchars($skill) ?>"><?= htmlspecialchars($skill) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="job_location" class="form-label">Job Location <span class="required">*</span></label>
                    <input type="text" id="job_location" name="job_location" class="form-input" placeholder="City, State or Remote" required>
                </div>
                
                <div class="form-group">
                    <label for="payment_amount" class="form-label">Payment Offer <span class="required">*</span></label>
                    <input type="text" id="payment_amount" name="payment_amount" class="form-input" placeholder="e.g. ₱500 - ₱5,000" required>
                </div>
                
                <div class="form-group">
                    <label for="job_description" class="form-label">Job Description <span class="required">*</span></label>
                    <textarea id="job_description" name="job_description" class="form-textarea" placeholder="Provide a detailed description of the job responsibilities, requirements, and benefits..." required></textarea>
                </div>
                
                <div class="form-footer">
                    <button class="submit-btn cancel" onclick="window.location.href='home.php';">Cancel</button>
                    <button type="submit" class="submit-btn post">Post Job</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>