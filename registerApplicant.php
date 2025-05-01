<?php
require_once 'classes/User.php';
require_once 'classes/Applicant.php';

$error = '';
$userType = 'applicant';
$skills = [
    'Skilled Labor',
    'Household & Maintenance',
    'Construction & Physical Work',
    'Food & Event Services',
    'Personal Care',
    'Errand & Utility Services',
    'Others'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $mainSkill = $_POST['main_skill'];
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $applicant = new Applicant($username, $email, $password, $userType, $mainSkill);
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
                    <label for="skills_required">Main Skills</label>
                    <select id="skills_required" name="main_skill" required>
                        <option value="">Select Main Skills</option>
                        <?php foreach ($skills as $skill): ?>
                            <option value="<?= htmlspecialchars($skill) ?>"><?= htmlspecialchars($skill) ?></option>
                        <?php endforeach; ?>
                    </select>
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