<?php
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

    if (!is_numeric($zipCode) || strlen($zipCode) < 4 || strlen($zipCode) > 10) {
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

    // Debugging: Output the hashed password
    echo "Hashed Password: " . $hashedPassword . "<br>";

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <link rel="stylesheet" href="assets/css/estyle.css"> -->
    <title>Hari Om Bag Center | Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <style>
        /* Add some additional styling */
        .wrapper {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px black;
        }

        .input-field {
            margin-bottom: 20px;
        }

        .input-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #04aa6d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #036f5a;
        }
    </style>
</head>

<body>
    <!-- Your existing navbar code -->
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
                            //   echo" <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=admin/login.php>Login as Admin</a>";
                        } else {

                            echo " <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=createads.php>Add advertisement</a>";

                            echo " <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=myAccountInfos.php>My account</a>";
                        }


                        ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <h2 class="title">Register</h2>
        <form action="" method="post" class="form">
            <div class="input-field">
                <label for="name" class="input-label">Full Name</label>
                <input type="name" name="username" id="username" class="input" placeholder="Enter your full name" required>
            </div>
            <div class="input-field">
                <label for="Phone Number" class="input-label">Phone Number</label>
                <input type="tel" name="phoneNumber" id="phoneNumber" class="input" placeholder="Enter your Phone Number" required>
            </div>
            <div class="input-field">
                <label for="zipCod" class="input-label">Zip Code</label>
                <input type="zipCode" name="zipCode" id="zipCode" class="input" placeholder="Enter your Zip Code" required>
            </div>
            <div class="input-field">
                <label for="email" class="input-label">Email</label>
                <input type="email" name="email" id="email" class="input" placeholder="Enter your email" required>
            </div>
            <div class="input-field">
                <label for="password" class="input-label">Password</label>
                <input type="password" name="password" id="password" class="input" placeholder="Enter your password" required>
            </div>
            <div class="input-field">
                <label for="cpassword" class="input-label">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" class="input" placeholder="Enter your confirm password" required>
            </div>
            <div class="input-field">
            </div>
            <button class="btn" name="submit">Register</button>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == 1) {
                    echo "<p style='color: red'>Email is already registered</p>";
                } elseif ($_GET["error"] == 2) {
                    echo "<p style='color: red'>Passwords do not match</p>";
                } elseif ($_GET["error"] == 3) {
                    echo "<p style='color: red'>Password needs to contain at least a letter, a number, and be longer than 4 characters</p>";
                } elseif ($_GET["error"] == 4) {
                    echo "<p style='color: red'>Invalid Phone Number</p>";
                } elseif ($_GET["error"] == 5) {
                    echo "<p style='color: red'>Your Phone number is already linked to an Account</p>";
                } elseif ($_GET["error"] == 6) {
                    echo "<p style='color: red'>Enter a Valid Email</p>";
                } elseif ($_GET["error"] == 7) {
                    echo "<p style='color: red'>Enter a Valid Zip Code</p>";
                } elseif ($_GET["error"] == 8) {
                    echo "<p style='color: red'>Your Username cannot be less than 5 characters</p>";
                } elseif ($_GET["error"] == 9) {
                    echo "<p style='color: red'>Username is already taken</p>";
                } elseif ($_GET["error"] == 10) {
                    echo "<p style='color: red'>Error Registering your account</p>";
                }
            }
            ?>
<br><br>
            <p>You have already an account! <a href="login.php">Login</a>.</p>
        </form>
    </div>
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Hari Om Bag Center</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Opp.Hotel Sifat International Surat, Railway Station Rd, opp. Surat Railway Station, Lal Darwaja, Varachha, Surat, Gujarat 395003
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">+91 89808 75690</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Categories</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">School Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Gym Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Trolley & Duffel Bags</a></li>
                        <li><a class="text-decoration-none" href="#">laptop Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Sky Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Tiffin Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Bum bags & Pooch bags</a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Home</a></li>
                        <li><a class="text-decoration-none" href="#">About Us</a></li>
                        <li><a class="text-decoration-none" href="#">Shop Locations</a></li>
                        <li><a class="text-decoration-none" href="#">FAQs</a></li>
                        <li><a class="text-decoration-none" href="#">Contact</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <!-- <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2021 Zay shop | Designed by Hawraa, Elia, Adrean, Charbel
                        </p>
                    </div> -->
                </div>
            </div>
        </div>

    </footer>
</body>

</html>