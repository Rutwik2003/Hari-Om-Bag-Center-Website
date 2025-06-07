<?php
require_once("connection/conn.php");
session_start();
if (!isset($_SESSION['loggedInUserId'])) {
    header("Location: login.php");
    exit();
}

$UserID = $_SESSION['loggedInUserId'];
$orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch order details
$orderQuery = mysqli_query($conShop, 
    "SELECT o.*, p.Title as productName, p.ImgPath as productImage, od.quantity, od.Price as itemPrice 
     FROM orders o 
     JOIN orderdetails od ON o.orderId = od.orderId 
     JOIN products p ON od.productId = p.ProductId 
     WHERE o.orderId = $orderId AND o.clientId = $UserID");

if (mysqli_num_rows($orderQuery) == 0) {
    header("Location: myAccountInfos.php");
    exit();
}

$orderInfo = mysqli_fetch_array(mysqli_query($conShop, 
    "SELECT * FROM orders WHERE orderId = $orderId AND clientId = $UserID"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Details - Hari Om Bag Center</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
        .order-details-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .product-image {
            max-width: 100px;
            height: auto;
        }
        .order-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container my-5">
        <div class="order-details-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Order #<?php echo $orderId; ?></h2>
                <a href="myAccountInfos.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Account
                </a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <h4>Order Items</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalAmount = 0;
                                while ($item = mysqli_fetch_array($orderQuery)) {
                                    $itemTotal = $item['quantity'] * $item['itemPrice'];
                                    $totalAmount += $itemTotal;
                                    echo "<tr>
                                        <td>" . $item['productName'] . "</td>
                                        <td><img src='assets/img/" . $item['productImage'] . "' class='product-image' alt='Product'></td>
                                        <td>" . $item['quantity'] . "</td>
                                        <td>₹" . number_format($item['itemPrice'], 2) . "</td>
                                        <td>₹" . number_format($itemTotal, 2) . "</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="order-summary">
                        <h4>Order Summary</h4>
                        <hr>
                        <p><strong>Order Date:</strong><br>
                            <?php echo date('d M Y', strtotime($orderInfo['DateOfOrder'])); ?>
                        </p>
                        <p><strong>Total Amount:</strong><br>
                            ₹<?php echo number_format($orderInfo['Price'], 2); ?>
                        </p>
                        <hr>
                        <a href="shop.php" class="btn btn-success w-100">
                            <i class="fas fa-shopping-bag"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
</body>
</html>