<?php
require_once("connection/conn.php");
session_start();

if(isset($_POST['razorpay_payment_id'])) {
    // Get cart items
    $cart = mysqli_query($conShop, "SELECT sc.*, p.Title, p.Price 
        FROM shoppingcart sc 
        JOIN products p ON sc.ProductId = p.ProductId 
        WHERE sc.clientId = $_SESSION[loggedInUserId]");

    while ($rowCart = mysqli_fetch_array($cart)) {
        $orderId = generateRandomString();
        $productId = $rowCart['ProductId'];
        $totalPrice = $rowCart['Price'];
        $quantity = $rowCart['Quantity'];
        $todaydate = date("Y-m-d");

        // Insert order
        $orderInsert = mysqli_query($conShop, "INSERT INTO orders (orderId, clientId, Price, DateOfOrder)
            VALUES ('$orderId', $_SESSION[loggedInUserId], $totalPrice, '$todaydate')");

        if($orderInsert) {
            // Insert into orderdetails
            mysqli_query($conShop, "INSERT INTO orderdetails (orderId, ProductId, Price, Quantity)
                VALUES ('$orderId', $productId, $totalPrice, $quantity)");

            // Remove from cart
            mysqli_query($conShop, "DELETE FROM shoppingcart 
                WHERE ProductId = '$productId' 
                AND clientId = $_SESSION[loggedInUserId]");
        }
    }

    // Redirect to success page
    header("Location: order_success.php");
    exit();
}

function generateRandomString($length = 50) {
    $characters = '123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>