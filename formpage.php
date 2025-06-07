
<?php
require_once("connection/conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hari Om Bag Center | Feedback</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .feedback-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: #04aa6d;
            box-shadow: 0 0 5px rgba(4,170,109,0.2);
            outline: none;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        .btn-submit {
            background-color: #04aa6d;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #038857;
            transform: translateY(-2px);
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .welcome-message {
            text-align: center;
            margin-bottom: 30px;
            color: #04aa6d;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="feedback-container">
        <?php if(isset($_SESSION['usernamelogin'])): ?>
            <div class="welcome-message">
                <h2>Welcome, <?php echo $_SESSION['usernamelogin']; ?></h2>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET["success"])): ?>
            <div class="alert alert-success">
                Your feedback has been submitted successfully!
            </div>
        <?php endif; ?>

        <?php if(isset($_GET["error"])): ?>
            <div class="alert alert-danger">
                <?php
                    switch($_GET["error"]) {
                        case 1:
                            echo "First name must include more than 3 characters";
                            break;
                        case 2:
                            echo "Last name must include more than 3 characters";
                            break;
                        case 3:
                            echo "Email must include more than 7 characters";
                            break;
                    }
                ?>
            </div>
        <?php endif; ?>

        <form action="formpage-inter.php" method="post">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstName" placeholder="Enter your first name">
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastName" placeholder="Enter your last name">
            </div>

            <div class="form-group">
                <label for="emailAddress">Email Address</label>
                <input type="email" class="form-control" name="email" id="emailAddress" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="comments">Your Feedback</label>
                <textarea class="form-control" name="comments" id="comments" rows="5" placeholder="We value your feedback"></textarea>
            </div>

            <button type="submit" class="btn-submit">Submit Feedback</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>





