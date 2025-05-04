<?php
require_once '../../src/auth.php';
require_once '../../classes/Employer.php';

// Get currently logged-in user ID
$currentUserId = $_SESSION['user']['userId'] ?? null;
$currentUser = null;

// Read the users.json file
$usersData = json_decode(file_get_contents('../../data/users.json'), true);

// Find the current employer in the JSON file
if ($currentUserId && $usersData) {
    foreach ($usersData as $user) {
        if ($user['userId'] === $currentUserId && $user['user_type'] === 'employer') {
            $currentUser = $user;
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['logout'])) {
        $employer = new Employer();
        $employer->logout();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Profile</title>
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
            <a href="upload.php" class="upload-btn">Post New Job</a>
        </div>
    </nav>

    <!-- Profile Section -->
    <section class="jobs-section">
        <h2 class="section-header">Your Profile</h2>

        <div class="profile-box">
            <?php if ($currentUser): ?>
                <div class="profile-item">
                    <label>User ID:</label> <?= htmlspecialchars($currentUser['userId']) ?>
                </div>
                <div class="profile-item">
                    <label>Username:</label> <?= htmlspecialchars($currentUser['username']) ?>
                </div>
                <div class="profile-item">
                    <label>Email:</label> <?= htmlspecialchars($currentUser['email']) ?>
                </div>
                <div class="profile-item">
                    <label>Business Name:</label> <?= htmlspecialchars($currentUser['businessName']) ?>
                </div>
                <div class="profile-item">
                    <label>Phone Number:</label> <em>Not set</em>
                </div>
                <div class="profile-item">
                    <label>Address:</label> <em>Not set</em>
                </div>
            <?php else: ?>
                <p>User not found or not logged in.</p>
            <?php endif; ?>
        </div>

        <!-- Logout Button -->
        <form method="POST" style="margin-top: 20px;">
            <button class="upload-btn" name="logout" type="submit">Logout</button>
        </form>
    </section>
</div>
</body>
</html>
