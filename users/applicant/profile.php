<?php 
require_once '../../classes/Applicant.php';

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if (isset($_POST['logout'])){
        $employer = new Applicant();
        $employer->logout();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Applicant</title>
    <link rel="stylesheet" href="../../css/navigations.css">
    <link rel="stylesheet" href="designs/home.css">
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="nav-links">
                <a href="home.php" class="nav-item">Home</a>
                <a href="#" class="nav-item active">Profile</a>
                <a href="#" class="nav-item">Notifications</a>
            </div>
        </nav>

        <!-- Profile Section -->
        <section class="jobs-section">
            <h2 class="section-header">Your Profile</h2>
            <div class="empty-state">
                <form method="POST">
                    <button class="upload-btn" name="logout" type="submit">Logout</button>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
