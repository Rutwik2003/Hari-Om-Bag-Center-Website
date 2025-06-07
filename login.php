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

    // SQL query to fetch user details
    $sql = "SELECT email, password, UserName, UserID FROM users WHERE email = ?";
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
            $_SESSION['usernamelogin'] = $row['UserName'];
            $_SESSION['loggedInUserId'] = $row['UserID'];
            header("Location:index.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Email not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login | Hari Om Bag Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .admin-login-btn {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .admin-login-btn:hover {
            background-color: #0056b3; /* Darker shade for hover effect */
            transform: scale(1.05); /* Slight zoom effect */
            text-decoration: none;
        }
    </style>
</head>
<?php include 'header.php';?>
<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="wrap-login-page">
                <div class="flex-grow flex flex-column justify-center gap30">
                    <div class="login-box">
                        <div>
                            <h3>Login to account</h3>
                            <div class="body-text">Enter your email & password to login</div>
                        </div>
                        <form class="form-login flex flex-column gap24" method="post" action="">
                            <fieldset class="email">
                                <div class="body-title mb-10">Email address <span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="email" placeholder="Enter your email address" name="email" required>
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10">Password <span class="tf-color-1">*</span></div>
                                <input class="password-input" type="password" placeholder="Enter your password" name="password" required>
                            </fieldset>
                            <div class="flex justify-between items-center">
                                <div class="flex gap10">
                                    <input type="checkbox" id="signed">
                                    <label class="body-text" for="signed">Keep me signed in</label>
                                </div>
                                <a href="#" class="body-text tf-color">Forgot password?</a>
                            </div>
                            <button type="submit" name="login" class="tf-button w-full">Login</button>
                        </form>
                        <?php if (isset($error)): ?>
                            <div class="error-message" style="color: red; text-align: center; margin-top: 10px;">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <div class="body-text text-center">
                            You don't have an account yet?
                            <a href="register.php" class="body-text tf-color">Register Now</a>
                            <br>
                            <br>
                            <?php echo "<a class='btn btn-primary admin-login-btn' href='admin/login.php'>Login as Admin</a>"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                <?php echo "<a class='btn btn-primary admin-login-btn' href='admin/login.php'>Login as Admin</a>"; ?>
            </form>
        </div>
    </div>
</body>

</html>