<?php
require_once("connection/conn.php");
session_start();

if (!isset($_SESSION['loggedInUserId'])) {
    header("Location: login.php");
    exit();
}

$UserID = $_SESSION['loggedInUserId'];
$message = '';

// Fetch current user data
$query = "SELECT * FROM users WHERE UserId = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $UserID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$userData = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    $updateQuery = "UPDATE users SET UserName = ?, Email = ?, phone = ? WHERE UserID = ?";
    $stmt = mysqli_prepare($con, $updateQuery);
    mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $phone, $UserID);
    
    if (mysqli_stmt_execute($stmt)) {
        $message = '<div class="alert alert-success">Profile updated successfully!</div>';
        $_SESSION['usernamelogin'] = $username; // Update session username
    } else {
        $message = '<div class="alert alert-danger">Error updating profile. Please try again.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile - Hari Om Bag Center</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <div class="profile-section">
        <div class="container">
            <h2 class="text-center">Edit Profile</h2>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="edit-form">
                    <?php echo $message; ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" 
                                value="<?php echo htmlspecialchars($userData['UserName'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                value="<?php echo htmlspecialchars($userData['Email'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                value="<?php echo htmlspecialchars($userData['phone'] ?? ''); ?>" 
                                pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                            <a href="myAccountInfos.php" class="btn btn-outline-secondary">Back to Profile</a>
                        </div>
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