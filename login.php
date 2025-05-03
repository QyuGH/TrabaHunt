<?php 
require_once 'classes/User.php';

session_start();

$result = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = $_POST['password'] ?? '' ;

    if (!empty($password)){
        $user = new User('', '', '', '');
        $result = $user->login($email, $password);
    }
    else {
        $error = "Password cannot be empty!";
    }

    if ($result === true) {
        if ($_SESSION['user']['user_type'] === 'employer') {
            header("Location: users/employer/home.php");
        } else {
            header("Location: users/applicant/home.php");
        }
        exit;
    } else {
        $error = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TrabaHunt</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>    
    <div class="container">
        <div class="form-container">
            <h2>Login to Your Account</h2>
            
            <?php if (!empty($error)): ?>
                <div class="alert error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group btns">
                    <button type="submit" class="btn">Login</button>
                    <button class="btn" onclick="window.location.href='index.php';">Back to Home</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>
