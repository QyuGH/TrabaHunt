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
                <a href="#" class="nav-item">Profile</a>
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
                $loggedUser = $_SESSION['user']['userId'];
                $jobs_file = '../../data/jobs.json';
                $query = isset($_GET['query']) ? strtolower(trim($_GET['query'])) : '';

                if (file_exists($jobs_file)) {
                    $jobs_data = file_get_contents($jobs_file);
                    $jobs = json_decode($jobs_data, true);

                    $match_found = false;

                    if (!empty($jobs)) {
                        foreach ($jobs as $job) {
                            $title = strtolower($job['jobTitle']);
                            $skills = strtolower($job['skills']);
                            $location = strtolower($job['jobLocation']);

                            $matches_search = $query === '' || strpos($title, $query) !== false || strpos($skills, $query) !== false || strpos($location, $query) !== false;

                            if ($matches_search) {
                                $match_found = true;
                                echo "<div class='job-post'>";
                                echo "<h3>" . htmlspecialchars($job['jobTitle']) . "</h3>";
                                echo "<p><strong>Skills Required:</strong> " . htmlspecialchars($job['skills']) . "</p>";
                                echo "<p><strong>Location:</strong> " . htmlspecialchars($job['jobLocation']) . "</p>";
                                echo "<p><strong>Payment:</strong> ₱" . htmlspecialchars($job['paymentAmount']) . "</p>";
                                echo "<p><strong>Description:</strong> " . htmlspecialchars($job['jobDescription']) . "</p>";
                                echo "<p><strong>Date Posted:</strong> " . htmlspecialchars($job['datePosted']) . "</p>";
                                echo "<form method='POST' action='apply.php' style='text-align: right;'>";
                                echo "<input type='hidden' name='jobId' value='" . htmlspecialchars($job['jobId']) . "'>";
                                echo "<button type='submit' class='upload-btn'>Apply</button>";
                                echo "</form>";
                                echo "</div>";
                            }
                        }

                        if (!$match_found) {
                            echo "<div class='empty-state'>No jobs match your search.</div>";
                        }
                    } else {
                        echo "<div class='empty-state'>No jobs are available at the moment.</div>";
                    }
                } else {
                    echo "<div class='empty-state'>No jobs file found.</div>";
                }
            ?>
        </section>
    </div>
</body>
</html>
