<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["login"])) {
    require_once("connection/conn.php");

    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $email = strtolower(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        die("SQL error: " . $con->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_regenerate_id(true);
            $_SESSION["SESSION_EMAIL"] = $email;
            echo "Password verified successfully!";
            session_regenerate_id(true);
            $_SESSION["SESSION_EMAIL"] = $email;
            $_SESSION['usernamelogin'] = $row['UserName'];
            $_SESSION['loggedInUserId'] = $row['UserID'];
            header("Location:index.php");
            exit;
        } else {
            echo "Password verification failed!";
            header("Location:login.php?error=1");
            exit;
        }
    } else {
        echo "Email not found in the database!";
        header("Location:login.php?error=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hari Om Bag Center | Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <!-- <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/css/style.css"> -->

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!--
    
balashna ba3d ma 3mlna include lal connection

-->
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php" style="margin-right: 5% ;">
                Hari Om Bag Center
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="formpage.php">Feedback</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">


                    <div style="padding-left: 30px; padding-right: 5px; padding-bottom:5px; padding-top: 5px ">
                        <?php
                        if (!isset($_SESSION['usernamelogin'])) {
                            echo "  <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \" href=login.php>Login</a>";
                            echo " <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=register.php>Sign Up</a>";
                        } else {
                            echo " <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=myAccountInfos.php>My account</a>";
                        }


                        ?>
                    </div>
                </div>
            </div>
        </div>

    </nav>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="assets/css/estyle.css"> -->

        <title>Login page</title>

        <!--Style Tag-->
        <style>
            .wrapper {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f9f9f9;
            }

            .pinkesh {
                background-color: #2c3e50;
                padding: 40px;
                width: 30%;
                border-radius: 15px;
                box-shadow: 0 3px 20px black;
                color: #ecf0f1;
            }

            .title {
                font-size: 28px;
                margin-bottom: 30px;
                text-align: center;
                font-weight: bold;
            }

            .input-field {
                margin-bottom: 25px;
            }

            .input {
                display: block;
                width: 100%;
                padding: 15px;
                border: 2px solid #3498db;
                border-radius: 8px;
                background: none;
                color: #ecf0f1;
                font-size: 16px;
            }

            .btn {
                background-color: #3498db;
                color: white;
                padding: 18px 25px;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                font-size: 16px;
                font-weight: bold;
            }

            .btn:hover {
                background-color: #2980b9;
            }
        </style>
        <!-- Style Tag End -->

    </head>

    <body>
        <div class="wrapper">
            <div class="pinkesh">
                <h2 class="title">Login</h2>
                <form action="" method="post" class="custom-login-container">
                    <div class="input-field">
                        <label for="email" class="custom-input-field input">Email</label>
                        <input type="email" name="email" id="email" class="input" placeholder="Enter your email" required>
                    </div>
                    <div class="input-field">
                        <label for="password" class="custom-input-field input">Password</label>
                        <input type="password" name="pwd" id="pwd" class="input" placeholder="Enter your password" required>
                    </div>
                    <button class="btn" name="login">Login</button>

                    <?php

                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == 1) {
                            echo "<p style='color: red'>Incorrect email or password</p>";
                        }
                    }
                    ?>
                    <br>
                    <br>
                    <p>Create Account! <a href="register.php">Register</a>.</p>
                    <?php echo " <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=admin/login.php>Login as Admin</a>";
                    ?>
                </form>
            </div>
        </div>
        <?php include_once("footer.php"); ?>
        <!-- End Script -->

        <script src="assets/js/jquery-1.11.0.min.js"></script>
        <script src="assets/js/jquery-migrate-1.2.1.m
    in.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/templatemo.js"></script>
        <script src="assets/js/custom.js"></script>

    </body>

    </html>