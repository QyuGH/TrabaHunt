<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Employer</title>
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
                <a href="upload.php" class="upload-btn">Post New Job</a>
            </div>
        </nav>

        <!-- Jobs Section -->
        <section class="jobs-section">
            <h2 class="section-header">Posted Jobs</h2>
            <?php
                require_once '../../src/auth.php';
                require_once '../../classes/Employer.php';

                $employer = new Employer();

                $employer->displayPostedJobs('../../data/jobs.json', $_SESSION['user']['userId']);
            ?>
        </section>

    </div>
</body>
</html>