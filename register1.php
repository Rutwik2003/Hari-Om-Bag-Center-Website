

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - Hari Om Bag Center</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
        .profile-section {
            background: linear-gradient(135deg, #04aa6d 0%, #049963 100%);
            padding: 40px 0;
            color: white;
            margin-bottom: 30px;
        }
        .edit-form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 50px;
        }
        .input-field {
            margin-bottom: 20px;
        }
        .error-message {
            color: #dc3545;
            margin-top: 5px;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <?php 
    session_start();
    require_once("connection/conn.php");
    $userid=$_SESSION['loggedInUserId'];
    $result = mysqli_query($con, "SELECT * from users Where UserID= $userid");
    $row = mysqli_fetch_array($result);
    ?>

    <div class="profile-section">
        <div class="container">
            <h2 class="text-center">Update Profile</h2>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="edit-form">
                    <form action="registerinter.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="username" class="form-control" 
                                value="<?php echo isset($row["UserName"]) ? htmlspecialchars($row["UserName"]) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phoneNumber" class="form-control" 
                                value="<?php echo isset($row["Phone"]) ? htmlspecialchars($row["Phone"]) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="zipCode" class="form-control" 
                                value="<?php echo isset($row["areaId"]) ? htmlspecialchars($row["areaId"]) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" 
                                value="<?php echo isset($row["Email"]) ? htmlspecialchars($row["Email"]) : ''; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Old Password</label>
                            <input type="password" name="Opassword" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="cpassword" class="form-control" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success" name="sub">Update Profile</button>
                            <a href="myAccountInfos.php" class="btn btn-outline-secondary">Back to Profile</a>
                        </div>

                        <?php 
                        if(isset($_GET["error"])) {
                            $errorMessages = [
                                1 => "Old Password Incorrect!! Enter the right one",
                                2 => "Passwords do not match",
                                3 => "Password need to contain at least a letter a number and longer than 4 character",
                                4 => "Invalid Phone Number",
                                6 => "Enter a Valid Email",
                                7 => "Enter a Valid Zip Code",
                                8 => "Your Username cannot be less than 5 characters",
                                10 => "Error Registering your account"
                            ];
                            if (isset($errorMessages[$_GET["error"]])) {
                                echo "<div class='alert alert-danger mt-3'>" . $errorMessages[$_GET["error"]] . "</div>";
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>

    <!-- Include Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>