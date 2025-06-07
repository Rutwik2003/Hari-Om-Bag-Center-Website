<?php
require_once("connection/conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Success - Hari Om Bag Center</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <style>
        .success-container {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
            padding: 30px;
        }
        .success-icon {
            color: #04aa6d;
            font-size: 80px;
            margin-bottom: 20px;
        }
        .success-message {
            background-color: #d4edda;
            border-left: 5px solid #04aa6d;
            padding: 20px;
            margin: 20px 0;
            text-align: left;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="success-container">
        <i class="fas fa-check-circle success-icon"></i>
        <h2>Order Placed Successfully!</h2>
        <div class="success-message">
            <p>Thank you for shopping with us. Your order has been placed successfully.</p>
            <p>You can track your order in the <a href="Orders.php">My Orders</a> section.</p>
        </div>
        <div class="mt-4">
            <a href="shop.php" class="btn btn-success">Continue Shopping</a>
            <a href="Orders.php" class="btn btn-outline-success">View Orders</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>