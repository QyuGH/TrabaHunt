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
                <a href="#" class="nav-item">Profile</a>
                <a href="#" class="nav-item">Notifications</a>
                <a href="upload.php" class="upload-btn">Post New Job</a>
            </div>
        </nav>

        <!-- Jobs Section -->
        <section class="jobs-section">
            <h2 class="section-header">Posted Jobs</h2>
            <?php
                // Read jobs from JSON file
                require_once '../../src/auth.php';
                $loggedUser = $_SESSION['user']['userId'];
                $jobs_file = '../../data/jobs.json';
                
                if (file_exists($jobs_file)) {
                    $jobs_data = file_get_contents($jobs_file);
                    $jobs = json_decode($jobs_data, true);

                    if (!empty($jobs)) {
                        $user_jobs = [];
                        foreach ($jobs as $job) {
                            if ($job['uploaderId'] === $loggedUser) {
                                $user_jobs[] = $job;
                            }
                        }
                
                        if (!empty($user_jobs)) {
                            foreach ($user_jobs as $job) {
                                echo "<div class='job-post'>";
                                echo "<h3>" . htmlspecialchars($job['jobTitle']) . "</h3>";
                                echo "<p><strong>Skills Required:</strong> " . htmlspecialchars($job['skills']) . "</p>";
                                echo "<p><strong>Location:</strong> " . htmlspecialchars($job['jobLocation']) . "</p>";
                                echo "<p><strong>Payment:</strong> ₱" . htmlspecialchars($job['paymentAmount']) . "</p>";
                                echo "<p><strong>Description:</strong> " . htmlspecialchars($job['jobDescription']) . "</p>";
                                echo "<p><strong>Date Posted:</strong> " . htmlspecialchars($job['datePosted']) . "</p>";
                                echo "</div>";
                            }
                        } else {
                            echo '<div class="empty-state">No jobs have been posted yet.</div>';
                        }
                    } else {
                        echo '<div class="empty-state">No jobs have been posted yet.</div>';
                    }
                } else {
                    echo '<div class="empty-state">No jobs have been posted yet.</div>';
                }
            ?>
        </section>

    </div>
</body>
</html>