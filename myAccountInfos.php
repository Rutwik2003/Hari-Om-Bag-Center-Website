<!DOCTYPE html>
<html lang="en">
<?php
require_once("connection/conn.php");
session_start();
if (!isset($_SESSION['loggedInUserId'])) {
    header("Location: login.php");
    exit();
}
$UserID = $_SESSION['loggedInUserId'];

// Fetch order and cart counts
$orderCount = mysqli_fetch_array(mysqli_query($conShop, 
    "SELECT COUNT(*) as count FROM orders WHERE clientId = $UserID"))['count'];

$cartCount = mysqli_fetch_array(mysqli_query($conShop, 
    "SELECT COUNT(*) as count FROM shoppingcart WHERE clientId = $UserID"))['count'];
?>
<head>
    <title>My Account - Hari Om Bag Center</title>
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
        .profile-info {
            text-align: center;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 60px;
            border: 4px solid white;
            margin-bottom: 15px;
        }
        .dashboard-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #04aa6d;
        }
        .action-btn {
            padding: 12px 25px;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 5px;
        }
        .order-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <div class="profile-section">
        <div class="container">
            <div class="profile-info">
                <img src="data:image/jpeg;base64,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" alt="Profile" class="profile-avatar">
                <h2><?php echo $_SESSION['usernamelogin']; ?></h2>
                <p>Welcome to Hari Om Bag Center!</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-card">
                    <h5><i class="fas fa-shopping-bag"></i> Orders</h5>
                    <div class="stat-number"><?php echo $orderCount; ?></div>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <h5><i class="fas fa-shopping-cart"></i> Cart</h5>
                    <div class="stat-number"><?php echo $cartCount; ?></div>
                    <p>Items in Cart</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <h5><i class="fas fa-rupee-sign"></i> Total Spent</h5>
                    <div class="stat-number">₹<?php 
                        $result = mysqli_query($conShop, "SELECT SUM(Price) as total FROM orders WHERE clientId = $UserID");
                        $total = mysqli_fetch_array($result)['total'];
                        echo number_format($total ?: 0, 2);
                    ?></div>
                    <p>Lifetime Value</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="dashboard-card">
                    <h4>Recent Orders</h4>
                    <div class="table-responsive">
                        <table class="table"> 
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $recentOrders = mysqli_query($conShop, 
                                    "SELECT orderId, DateOfOrder, price FROM orders WHERE clientId = $UserID ORDER BY orderId DESC LIMIT 5");
                                while ($order = mysqli_fetch_array($recentOrders)) {
                                    echo "<tr>
                                        <td>#" . $order['orderId'] . "</td>
                                        <td>" . date('d M Y', strtotime($order['DateOfOrder'])) . "</td>
                                        <td>₹" . number_format($order['price'], 2) . "</td>
                                        <td><a href='order-details.php?id=" . $order['orderId'] . "' 
                                            class='btn btn-sm btn-outline-success'>View</a></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h4>Quick Actions</h4>
                    <div class="d-grid gap-2">
                        <a href="ShoppingCart.php" class="btn btn-success action-btn">
                            <i class="fas fa-shopping-cart"></i> View Cart
                        </a>
                        <a href="Orders.php" class="btn btn-primary action-btn">
                            <i class="fas fa-box"></i> All Orders
                        </a>
                        <a href="edit-profile.php" class="btn btn-info action-btn">
                            <i class="fas fa-user-edit"></i> Edit Profile
                        </a>
                        <a href="register1.php" class="btn btn-warning action-btn">
                            <i class="fas fa-key"></i> Change Password
                        </a>
                        <a href="logout.php" class="btn btn-danger action-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
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

