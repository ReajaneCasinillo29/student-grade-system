<?php
session_start();

if(isset($_SESSION['user'])){
    header("Location: dashboard.php");
    exit();
}

// Initialize login attempt tracking
if(!isset($_SESSION['login_attempts'])){
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_time'] = null;
}

$error = "";
$is_locked = false;
$lockout_seconds = 30;
$max_attempts = 3;

// Check lockout status
if($_SESSION['lockout_time'] !== null){
    $elapsed = time() - $_SESSION['lockout_time'];
    if($elapsed < $lockout_seconds){
        $remaining = $lockout_seconds - $elapsed;
        $is_locked = true;
        $error = "Too many failed attempts. Please wait <strong>{$remaining}</strong> second(s) before trying again.";
    } else {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['lockout_time'] = null;
    }
}

// Pre-fill username from Remember Me cookie
$remembered_username = isset($_COOKIE['remember_username'])
    ? htmlspecialchars($_COOKIE['remember_username'])
    : '';

if(isset($_POST['login']) && !$is_locked){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    // Server-side validation
    if(empty($username) || empty($password)){
        $error = "Username and password are required.";
    } elseif(strlen($username) < 3){
        $error = "Username must be at least 3 characters long.";
    } elseif(strlen($password) < 4){
        $error = "Password must be at least 4 characters long.";
    } elseif($username === "admin" && $password === "admin"){

        $_SESSION['user'] = "Administrator";
        $_SESSION['login_attempts'] = 0;
        $_SESSION['lockout_time'] = null;
        $_SESSION['login_time'] = date('Y-m-d H:i:s');

        // Handle Remember Me
        if($remember){
            setcookie('remember_username', $username, time() + (30 * 24 * 60 * 60), '/');
        } else {
            setcookie('remember_username', '', time() - 3600, '/');
        }

        header("Location: dashboard.php");
        exit();

    } else {
        $_SESSION['login_attempts']++;

        if($_SESSION['login_attempts'] >= $max_attempts){
            $_SESSION['lockout_time'] = time();
            $is_locked = true;
            $error = "Too many failed attempts. Please wait <strong>{$lockout_seconds}</strong> seconds before trying again.";
        } else {
            $attempts_left = $max_attempts - $_SESSION['login_attempts'];
            $error = "Invalid Username or Password! <strong>{$attempts_left}</strong> attempt(s) remaining.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login &mdash; Student Grading System</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body class="login-body">

<div class="login-container">

    <div class="login-card">

        <div class="login-header">
            <div class="login-icon">&#127979;</div>
            <h1>Student Grading System</h1>
            <p>Sign in to your account to continue.</p>
        </div>

        <?php if($error !== ""): ?>
        <div class="alert alert-error" id="loginAlert">
            <span class="alert-icon">&#9888;</span>
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="POST" id="loginForm" onsubmit="return handleSubmit(this)" novalidate>

            <div class="form-group" id="group-username">

                <label for="username">Username</label>

                <div class="input-wrapper">
                    <span class="input-icon">&#128100;</span>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter your username"
                        value="<?php echo $remembered_username; ?>"
                        autocomplete="username"
                        <?php echo $is_locked ? 'disabled' : ''; ?>
                        required>
                </div>

                <span class="field-error" id="error-username"></span>

            </div>

            <div class="form-group" id="group-password">

                <label for="password">Password</label>

                <div class="input-wrapper">
                    <span class="input-icon">&#128274;</span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        <?php echo $is_locked ? 'disabled' : ''; ?>
                        required>
                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword()"
                        tabindex="-1"
                        title="Show/Hide password"
                        id="toggleBtn">
                        &#128065;
                    </button>
                </div>

                <span class="field-error" id="error-password"></span>

            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        <?php echo $remembered_username ? 'checked' : ''; ?>>
                    <span>Remember me</span>
                </label>
            </div>

            <button
                type="submit"
                name="login"
                class="btn"
                id="loginBtn"
                <?php echo $is_locked ? 'disabled' : ''; ?>>

                <span id="btnText">Login</span>
                <span id="btnSpinner" class="spinner" style="display:none;"></span>

            </button>

        </form>

        <div class="demo">
            <strong>Demo Credentials</strong><br>
            Username: <code>admin</code> &nbsp;|&nbsp; Password: <code>admin</code>
        </div>

    </div>

    <footer class="login-footer">
        &copy; <?php echo date('Y'); ?> Student Grading System. All rights reserved.
    </footer>

</div>

<script src="js/app.js"></script>

</body>

</html>
