<?php
require_once 'classes/User.php';
require_once 'classes/Applicant.php';

$error = '';
$userType = 'applicant';
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $mainSkill = $_POST['main_skill'];
    $contact = $_POST['address'];
    $address = $_POST['address'];
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $applicant = new Applicant($username, $address, $contact, $email, $password, $userType, $mainSkill);
        $applicantData = $applicant->getApplicantData();
        $result = $applicant->registerUser($applicantData);

        if ($result === true) {
            header('Location: login.php');
            exit;
        } else {
            $error = $result; 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Registration - TrabaHunt</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>    
    <div class="container">
        <div class="form-container">
            <h2>Create an Account</h2>
            
            <?php if (!empty($error)): ?>
                <div class="alert error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="skills_required">Main Expertise</label>
                    <select id="skills_required" name="main_skill" required>
                        <option value="">Select Main Expertise</option>
                        <?php foreach ($skills as $skill): ?>
                            <option value="<?= htmlspecialchars($skill) ?>"><?= htmlspecialchars($skill) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="contact">Contact Number:</label>
                    <input type="tel" id="contact" name="contact" pattern="[0-9]{11}" placeholder="09XXXXXXXXX" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" placeholder="123 Main St, City, Province" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <div class="form-group btns">
                    <button type="submit" class="btn">Register</button>
                    <button type="submit" class="btn" onclick="window.location.href='registerEmployer.php';">Register As Employer</button>
                    <button type="submit" class="btn" onclick="window.location.href='index.php';">Back to Home</button>
                </div>
                
                <p class="text-center">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>