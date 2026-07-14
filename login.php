<?php
session_start();

if(isset($_SESSION['user'])){
    header("Location: dashboard.php");
    exit();
}

$error = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if($username == "admin" && $password == "admin"){

        $_SESSION['user'] = "Administrator";

        header("Location: dashboard.php");
        exit();

    }else{

        $error = "Invalid Username or Password!";

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Grading System</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="login-container">

    <div class="login-card">

        <h1>Student Grading System</h1>

        <p>Please login to continue.</p>

        <?php
        if($error!=""){
            echo "<div class='error'>$error</div>";
        }
        ?>

        <form method="POST">

            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Enter Username"
                    required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter Password"
                    required>

            </div>

            <button
                type="submit"
                name="login"
                class="btn">

                Login

            </button>

        </form>

        <div class="demo">

            <strong>Demo Account</strong><br>

            Username : admin <br>
            Password : 1234

        </div>

    </div>

</div>

<script src="js/app.js"></script>

</body>

</html>