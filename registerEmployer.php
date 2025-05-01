<?php
require_once 'classes/User.php';
require_once 'classes/Employer.php';

$error = '';
$userType = 'employer';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $businessName = (!empty($_POST['business_name']) ? $_POST['business_name'] : 'Not Specified');

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $employer = new Employer($username, $email, $password, $userType, $businessName);
        $employerData = $employer->getEmployerData();
        $result = $employer->registerUser($employerData);

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
    <title>Employer Registration - TrabaHunt</title>
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
                    <label for="business_name">Business Name</label>
                    <input type="text" id="business_name" name="business_name" placeholder="Optional">
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
                    <button type="submit" class="btn" onclick="window.location.href='registerApplicant.php';">Register As Applicant</button>
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