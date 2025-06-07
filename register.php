<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["submit"])) {
    require_once("connection/conn.php");

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $phoneNumber = trim($_POST["phoneNumber"]);
    $zipCode = trim($_POST["zipCode"]);
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Input validation
    if (strlen($username) < 5) {
        header("Location:register.php?error=8");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:register.php?error=6");
        exit;
    }

    if (!is_numeric($phoneNumber) || strlen($phoneNumber) !== 10) {
        header("Location:register.php?error=4");
        exit;
    }

    if (!is_numeric($zipCode) || strlen($zipCode) < 1 || strlen($zipCode) > 2) {
        header("Location:register.php?error=7");
        exit;
    }

    if (strlen($password) < 4 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
        header("Location:register.php?error=3");
        exit;
    }

    if ($password !== $cpassword) {
        header("Location:register.php?error=2");
        exit;
    }

    // Check for duplicate username
    $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("Location:register.php?error=9"); // Error code for duplicate username
        exit;
    }

    // Check for duplicate email
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("Location:register.php?error=1");
        exit;
    }

    // Check for duplicate phone number
    $stmt = $con->prepare("SELECT * FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phoneNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("Location:register.php?error=5");
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $stmt = $con->prepare("INSERT INTO users (username, phone, email, areaId, type, password) VALUES (?, ?, ?, ?, ?, ?)");
    $type = 1; // Assuming type is always 1
    $stmt->bind_param("ssssis", $username, $phoneNumber, $email, $zipCode, $type, $hashedPassword);

    if ($stmt->execute()) {
        header("Location:login.php");
        exit;
    } else {
        header("Location:register.php?error=10");
        exit;
    }
}

// Include Header

?>
<!DOCTYPE html>
<?php include 'header.php';?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Remos eCommerce Admin Dashboard HTML Template</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/animation.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">



    <!-- Font -->
    <link rel="stylesheet" href="font/fonts.css">

    <!-- Icon -->
    <link rel="stylesheet" href="icon/style.css">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">

</head>

<body class="body">

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <div class="wrap-login-page sign-up">
                <div class="flex-grow flex flex-column justify-center gap30">
                    <a href="index.html" id="site-logo-inner">
                        
                    </a>
                    <div class="login-box">
                        <div>
                            <h3>Create your account</h3>
                            <div class="body-text">Enter your personal details to create account</div>
                        </div>
                        <form class="form-login flex flex-column gap24" method="post" action="">
                            <fieldset class="name">
                                <div class="body-title mb-10">Your username <span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="text" placeholder="Enter your full name" name="username" required>
                            </fieldset>
                            <fieldset class="email">
                                <div class="body-title mb-10">Email address <span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="email" placeholder="Enter your email address" name="email" required>
                            </fieldset>
                            <fieldset class="phone">
                                <div class="body-title mb-10">Phone Number <span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="tel" placeholder="Enter your phone number" name="phoneNumber" required>
                            </fieldset>
                            <fieldset class="zip">
                                <div class="body-title mb-10">Zip Code <span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="text" placeholder="Enter your zip code" name="zipCode" required>
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10">Password <span class="tf-color-1">*</span></div>
                                <input class="password-input" type="password" placeholder="Enter your password" name="password" required>
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10">Confirm Password <span class="tf-color-1">*</span></div>
                                <input class="password-input" type="password" placeholder="Confirm your password" name="cpassword" required>
                            </fieldset>
                            <button type="submit" name="submit" class="tf-button w-full">Register</button>
                        </form>
                        <?php if (isset($_GET["error"])): ?>
                            <div class="error-message" style="color: red; text-align: center; margin-top: 10px;">
                                <?php
                                switch ($_GET["error"]) {
                                    case 1: echo "Email is already registered."; break;
                                    case 2: echo "Passwords do not match."; break;
                                    case 3: echo "Password must contain at least a letter, a number, and be longer than 4 characters."; break;
                                    case 4: echo "Invalid phone number."; break;
                                    case 5: echo "Phone number is already linked to an account."; break;
                                    case 6: echo "Enter a valid email."; break;
                                    case 7: echo "Enter a valid zip code."; break;
                                    case 8: echo "Username must be at least 5 characters long."; break;
                                    case 9: echo "Username is already taken."; break;
                                    case 10: echo "Error registering your account."; break;
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="body-text text-center">
                            You have an account?
                            <a href="login.php" class="body-text tf-color">Login Now</a>
                        </div>
                    </div>
                </div>
                <div class="text-tiny">Copyright © 2024 Remos, All rights reserved.</div>
            </div>
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->

    <!-- Javascript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>