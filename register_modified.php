<?php
if (isset($_POST["submit"])) {

    require_once("connection/conn.php");

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $phoneNumber = trim($_POST["phoneNumber"]);
    $zipCode = trim($_POST["zipCode"]);
    $password = $_POST["password"];
    $cpassword =  $_POST["cpassword"];

    if (strlen($username) < 5) {
        header("Location:register.php?error=8");
    } elseif (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email='$email'")) > 0) {
        header("Location:register.php?error=1");
    } elseif (strlen($phoneNumber) < 8 || strlen($phoneNumber) > 14 || !(is_numeric($phoneNumber))) {
        header("Location:register.php?error=4");
    } elseif (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE phone='$phoneNumber'"))) {
        header("Location:register.php?error=5");
    } elseif (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        header("Location:register.php?error=6");
    } elseif (strlen($zipCode) < 0) {
        header("Location:register.php?error=7");
    } elseif (strlen($password) < 4 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
        header("Location:register.php?error=3");
    } elseif (!($password === $cpassword)) {
        header("Location:register.php?error=2");
    } else {
        $md5pass = md5($password);
        $sql = "INSERT INTO users(username,phone,email,areaId,type,password) VALUES('$username','$phoneNumber','$email','$zipCode',1,'$md5pass') ";

        $result = mysqli_query($con, $sql);
        if ($result) {
            header("Location:login.php");
        } else {
            header("Location:register.php?error=10");
        }
    }
}

?>

<?php
// Your PHP code here
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <!-- Add your CSS links here -->
    <style>
        /* Inline CSS for demonstration */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        header {
            background: #50b3a2;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .form-wrap {
            background: #fff;
            padding: 15px 25px;
            color: #333;
            border-radius: 8px;
            position: relative;
            box-shadow: 0px 0px 5px 0px #000;
            margin: 20px 0;
        }

        .form-wrap h2 {
            font-size: 24px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .form-wrap label {
            font-size: 18px;
        }

        .form-wrap input[type="text"],
        .form-wrap input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        .btn {
            background-color: #50b3a2;
            color: white;
            padding: 14px 20px;
            margin: 20px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        footer {
            background: #50b3a2;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <h1>Registration Page</h1>
    </header>

    <div class="container">
        <div class="form-wrap">
            <h2>Register</h2>
            <form action="" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" required>
                <!-- Add more input fields here -->
                <input type="submit" class="btn" name="submit" value="Register">
            </form>
        </div>
    </div>

    <footer>
        <p>Copyright &copy; 2023. All rights reserved.</p>
    </footer>

</body>

</html>