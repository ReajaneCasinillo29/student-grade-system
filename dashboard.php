<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="sidebar">

    <div class="logo">
        <h2>SGS</h2>
    </div>

    <ul>

        <li class="active">
            <a href="dashboard.php">
                🏠 Dashboard
            </a>
        </li>

        <li>
            <a href="grades.php">
                📖 Grades
            </a>
        </li>

        <li>
            <a href="logout.php" onclick="return confirmLogout();">
                🚪 Logout
            </a>
        </li>

    </ul>

</div>

<div class="main-content">

    <div class="header">

        <h1>Dashboard</h1>

        <div class="user-info">

            Welcome,

            <strong>

                <?php echo $user; ?>

            </strong>

        </div>

    </div>


    <div class="cards">

        <div class="card">

            <h3>Total Students</h3>

            <h1>150</h1>

        </div>

        <div class="card">

            <h3>Total Subjects</h3>

            <h1>8</h1>

        </div>

        <div class="card">

            <h3>Teachers</h3>

            <h1>12</h1>

        </div>

        <div class="card">

            <h3>Passed Students</h3>

            <h1>145</h1>

        </div>

    </div>


    <div class="welcome-box">

        <h2>Welcome to the Student Grading System</h2>

        <p>

            This project demonstrates a simple PHP grading system
            using Sessions, CSS and JavaScript.

        </p>

        <button onclick="welcomeMessage()" class="btn">

            Show Welcome Message

        </button>

    </div>


    <div class="quick-menu">

        <h2>Quick Menu</h2>

        <div class="menu-grid">

            <div class="menu-card">

                <h3>Grades</h3>

                <p>View student grades.</p>

                <a href="grades.php">

                    <button class="btn">

                        Open

                    </button>

                </a>

            </div>

            <div class="menu-card">

                <h3>Dashboard</h3>

                <p>View summary information.</p>

                <button
                    class="btn"
                    onclick="showDate()">

                    Show Date

                </button>

            </div>

        </div>

    </div>


    <div class="announcement">

        <h2>Announcements</h2>

        <ul>

            <li>✔ Midterm grades are now available.</li>

            <li>✔ Final examination starts next week.</li>

            <li>✔ Students may print their grades.</li>

        </ul>

    </div>


    <footer>

        <p>

            Student Grading System &copy;
            <?php echo date("Y"); ?>

        </p>

    </footer>

</div>

<script src="js/app.js"></script>

</body>

</html>