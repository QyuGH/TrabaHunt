<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Applicant</title>
    <link rel="stylesheet" href="designs/home.css">
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="nav-links">
                <a href="#" class="nav-item active">Home</a>
                <a href="profile.php" class="nav-item">Profile</a>
                <a href="#" class="nav-item">Notifications</a>
                <!-- Search bar -->
                <form class="search-form" method="GET" action="">
                    <input type="text" name="query" placeholder="Search jobs..." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
        </nav>

        <!-- Jobs Section -->
        <section class="jobs-section">
            <h2 class="section-header">Available Jobs</h2>
            <?php
                require_once '../../src/auth.php';
                require_once '../../classes/Applicant.php';

                $applicant = new Applicant();
                $applicant->browseJobs();
            ?>
        </section>
    </div>
</body>
</html>
