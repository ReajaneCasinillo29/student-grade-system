<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];


$grades = [

    "Programming 1"      => 98,
    "Database Systems"   => 95,
    "Networking"         => 94,
    "Web Development"    => 97,
    "Mathematics"        => 91,
    "Science"            => 92,
    "English"            => 90,
    "Physical Education" => 96

];

$total = 0;

foreach($grades as $grade){
    $total += $grade;
}

$average = $total / count($grades);
$averageRemark = remarks($average);


function equivalent($grade){

    if($grade >= 98) return "1.00";
    elseif($grade >=95) return "1.25";
    elseif($grade >=92) return "1.50";
    elseif($grade >=89) return "1.75";
    elseif($grade >=86) return "2.00";
    elseif($grade >=83) return "2.25";
    elseif($grade >=80) return "2.50";
    elseif($grade >=77) return "2.75";
    elseif($grade >=75) return "3.00";

    return "5.00";

}

function remarks($grade){

    if($grade >= 75){
        return "PASSED";
    }

    return "FAILED";

}

$passed = 0;

foreach ($grades as $grade) {
    if ($grade >= 75) {
        $passed++;
    }
}

?>
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Grades</title>

<link rel="stylesheet"
href="css/style.css">

</head>

<body>

<div class="sidebar">

    <div class="logo">

        <h2>SGS</h2>

    </div>

    <ul>

        <li>

            <a href="dashboard.php">

                🏠 Dashboard

            </a>

        </li>

        <li class="active">

            <a href="grades.php">

                📖 Grades

            </a>

        </li>

        <li>

            <a href="logout.php"
            onclick="return confirmLogout()">

                🚪 Logout

            </a>

        </li>

    </ul>

</div>

<div class="main-content">

<div class="header">

<h1>Student Grades</h1>

<div>

Logged in as

<strong>

<?php echo htmlspecialchars($user, ENT_QUOTES, 'UTF-8'); ?>

</strong>

</div>

</div>

<div class="welcome-box">

<h2>Grade Summary</h2>

<p>

Overall Average:

<strong>

<?php echo number_format($average,2); ?>

</strong>

</p>

</div>

<input

type="text"

id="search"

placeholder="Search Subject..."

onkeyup="searchTable()"

class="search-box"

>

<table id="gradeTable">

<thead>

<tr>

<th>Subject</th>

<th>Grade</th>

<th>Equivalent</th>

<th>Remarks</th>

</tr>

</thead>

<tbody>

<?php

foreach($grades as $subject=>$grade){

?>

<tr>

<td>

<?php echo $subject; ?>

</td>

<td>

<?php echo $grade; ?>

</td>

<td>

<?php echo equivalent($grade); ?>

</td>

<td>

<?php echo remarks($grade); ?>

</td>

</tr>

<?php

}

?>

</tbody>

<tfoot>

<tr>

<th>

Average

</th>

<th>

<?php

echo number_format($average,2);

?>

</th>

<th colspan="2">

<?php

echo $averageRemark;

?>

</th>

</tr>

</tfoot>

</table>

<div class="cards">

<div class="card">

<h3>Total Subjects</h3>

<h1>

<?php

ksort($grades);

echo count($grades);

?>

</h1>

</div>

<div class="card">

<h3>Average</h3>

<h1>

<?php

echo number_format($average,2);

?>

</h1>

</div>

<div class="card">

<h3>Status</h3>

<h1>

<?php

echo remarks($average);

?>

</h1>

</div>

<div class="card">
    <h3>Passed Subjects</h3>
    <h1><?php echo $passed; ?></h1>
</div>

</div>

<footer>

<p>

Student Grading System

©

<?php echo date("Y"); ?>

</p>

</footer>

</div>

<script src="js/app.js"></script>

</body>

</html>