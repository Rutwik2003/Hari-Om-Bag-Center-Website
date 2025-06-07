<!DOCTYPE html>
<html lang="en">
<?php
require_once("connection/conn.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedInUserId'])) {
    header("Location: login.php");
    exit();
}
?>

<head>
    <title>Hari Om Bag Center | My Orders</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .orders-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .order-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 0;
        }
        .order-header {
            background: #f6f6f6;
            border-bottom: 1px solid #ddd;
            padding: 15px 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .order-date, .order-id, .order-total {
            color: #565959;
            font-size: 0.9em;
        }
        .order-total {
            text-align: right;
            font-weight: bold;
        }
        .order-content {
            padding: 20px;
            display: flex;
            gap: 20px;
        }
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .product-details {
            flex-grow: 1;
        }
        .product-title {
            font-size: 1.1em;
            margin-bottom: 10px;
            color: #0066c0;
        }
        .product-title:hover {
            color: #c45500;
            text-decoration: underline;
        }
        .product-meta {
            color: #565959;
            font-size: 0.9em;
            margin-bottom: 5px;
        }
        .page-title {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .shop-link {
            display: inline-block;
            padding: 10px 25px;
            background: #04aa6d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .shop-link:hover {
            background: #038857;
            transform: scale(1.05);
        }
        
        .floating-offer {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #ff4444;
            color: white;
            padding: 15px 25px;
            border-radius: 50px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: all 0.3s ease;
            text-decoration: none;
            display: none;
        }
        
        .floating-offer:hover {
            transform: scale(1.05);
            background: #ff2222;
            color: white;
            text-decoration: none;
        }
        
        .floating-offer i {
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="orders-container">
        <h1 class="page-title">My Orders</h1>
        <div class="text-center mb-4">
            <a href='Shop.php' class="shop-link">Continue Shopping</a>
        </div>

        <?php
        // Check for active offers
        $checkOffers = mysqli_query($conShop, "SELECT * FROM offers WHERE active = 1 AND expiry_date > CURRENT_TIMESTAMP LIMIT 1");
        if(mysqli_num_rows($checkOffers) > 0) {
            $offer = mysqli_fetch_array($checkOffers);
            echo '<a href="offers.php" class="floating-offer" style="display: block;">
                <i class="fa fa-gift"></i> ' . htmlspecialchars($offer['title']) . '
            </a>';
        }
        ?>

        // Get all orders for the user
        // In the orders container section, update the query:
        $orders = mysqli_query($conShop, "SELECT o.orderId, o.clientId, o.DateOfOrder, o.Price,
            COUNT(od.ProductId) as TotalItems
            FROM orders o
            LEFT JOIN orderdetails od ON o.orderId = od.orderId
            WHERE o.clientId = '" . $_SESSION['loggedInUserId'] . "'
            GROUP BY o.orderId, o.DateOfOrder, o.Price
            ORDER BY o.DateOfOrder DESC");
    
        if(mysqli_num_rows($orders) > 0) {
            while ($rowOrder = mysqli_fetch_array($orders)) {
                $orderProducts = mysqli_query($conShop, "SELECT p.*, od.Quantity, od.Price as OrderPrice 
                    FROM orderdetails od
                    JOIN products p ON od.ProductId = p.ProductId
                    WHERE od.orderId = '{$rowOrder['orderId']}'");
                
                echo "<div class='order-card'>
                    <div class='order-header'>
                        <div>
                            <div class='order-date'>ORDER PLACED</div>
                            <div>" . date('d M Y', strtotime($rowOrder['DateOfOrder'])) . "</div>
                        </div>
                        <div>
                            <div class='order-id'>ORDER #</div>
                            <div>" . substr($rowOrder['orderId'], -8) . "</div>
                        </div>
                        <div class='order-total'>
                            <div>Total Items: " . $rowOrder['TotalItems'] . "</div>
                            <div>₹" . number_format($rowOrder['Price'], 2) . "</div>
                        </div>
                    </div>";

                $firstProduct = mysqli_fetch_array($orderProducts);
                if ($firstProduct) {
                    echo "<div class='order-content'>
                        <img src='" . $firstProduct['ImgPath'] . "' class='product-image' alt='" . $firstProduct['Title'] . "'>
                        <div class='product-details'>
                            <a href='shop-single.php?productId=" . $firstProduct['ProductId'] . "' class='product-title'>" . $firstProduct['Title'] . "</a>
                            <div class='product-meta'>Quantity: " . $firstProduct['Quantity'] . "</div>
                            <div class='product-meta'>Price: ₹" . number_format($firstProduct['OrderPrice'], 2) . "</div>
                        </div>
                    </div>";
                } else {
                    echo "<div class='order-content'>
                        <img src='assets/img/default-product.jpg' class='product-image' alt='Product Image'>
                        <div class='product-details'>
                            <span class='product-title'>Order Details Not Available</span>
                            <div class='product-meta'>Order Date: " . $rowOrder['DateOfOrder'] . "</div>
                        </div>
                    </div>";
                }
                echo "</div>";
            }
        } else {
            echo "<div class='text-center mt-4'>
                <p>No orders found.</p>
            </div>";
        }

        // Reset pointer to get remaining products
        mysqli_data_seek($orderProducts, 1);
        $remainingProducts = mysqli_num_rows($orderProducts) - 1;

        if($remainingProducts > 0) {
            echo "<div class='more-products'>
                <button class='btn btn-link' type='button' data-bs-toggle='collapse' 
                        data-bs-target='#order" . $rowOrder['orderId'] . "'>
                    Show More Items (" . $remainingProducts . " more)
                </button>
                <div class='collapse' id='order" . $rowOrder['orderId'] . "'>";
            
            while ($product = mysqli_fetch_array($orderProducts)) {
                echo "<div class='order-content'>
                    <img src='" . $product['ImgPath'] . "' class='product-image' alt='" . $product['Title'] . "'>
                    <div class='product-details'>
                        <a href='shop-single.php?productId=" . $product['ProductId'] . "' class='product-title'>" . $product['Title'] . "</a>
                        <div class='product-meta'>Quantity: " . $product['Quantity'] . "</div>
                        <div class='product-meta'>Price: ₹" . number_format($product['OrderPrice'], 2) . "</div>
                    </div>
                </div>";
            }
            
            echo "</div></div>";
        }
    } else {
        echo "<div class='order-content'>
            <img src='assets/img/default-product.jpg' class='product-image' alt='Product Image'>
            <div class='product-details'>
                <span class='product-title'>Order Details Not Available</span>
                <div class='product-meta'>Order Date: " . $rowOrder['DateOfOrder'] . "</div>
            </div>
        </div>";
    }

    if($rowOrder['TotalItems'] > 1) {
        echo "<div class='more-products'>
            <button class='btn btn-link' type='button' data-bs-toggle='collapse' 
                    data-bs-target='#order" . $rowOrder['orderId'] . "'>
                Show More Items (" . ($rowOrder['TotalItems'] - 1) . " more)
            </button>
            <div class='collapse' id='order" . $rowOrder['orderId'] . "'>";
        
        while ($product = mysqli_fetch_array($orderProducts)) {
            echo "<div class='order-content'>
                <img src='" . $product['ImgPath'] . "' class='product-image' alt='" . $product['Title'] . "'>
                <div class='product-details'>
                    <a href='shop-single.php?productId=" . $product['ProductId'] . "' class='product-title'>" . $product['Title'] . "</a>
                    <div class='product-meta'>Quantity: " . $product['Quantity'] . "</div>
                    <div class='product-meta'>Price: ₹" . number_format($product['OrderPrice'], 2) . "</div>
                </div>
            </div>";
        }
        
        echo "</div></div>";
    }
    
    // Commenting out the Track Package button
    /*
    echo "<div class='order-actions'>
            <a href='trackpackage.php?order_id=" . $rowOrder['orderId'] . "' class='btn-track'>Track Package</a>
        </div>";
    */
    echo "</div>";
    }
    ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const offerBtn = document.querySelector('.floating-offer');
            if(offerBtn) {
                offerBtn.style.display = 'block';
                
                // Optional: Add animation
                offerBtn.style.animation = 'fadeIn 0.5s ease-in';
            }
        });
    </script>
</body>
    
    <?php
    // Add this before closing body tag
    $checkOffers = mysqli_query($conShop, "SELECT * FROM offers WHERE active = 1 AND expiry_date > NOW() LIMIT 1");
    if(mysqli_num_rows($checkOffers) > 0) {
        echo '<a href="offers.php" class="floating-offer">
            <i class="fa fa-gift"></i> Special Offers Available!
        </a>';
    }
    ?>

</html>