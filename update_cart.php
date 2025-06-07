<?php
require_once("connection/conn.php");
session_start();

if (!isset($_SESSION['loggedInUserId'])) {
    http_response_code(401);
    exit('Not logged in');
}

if (isset($_POST['cartId']) && isset($_POST['quantity'])) {
    $cartId = mysqli_real_escape_string($conShop, $_POST['cartId']);
    $quantity = mysqli_real_escape_string($conShop, $_POST['quantity']);
    $userId = $_SESSION['loggedInUserId'];

    // Verify cart item belongs to user
    $checkQuery = "SELECT * FROM shoppingcart WHERE ShoppingCartId = '$cartId' AND clientId = '$userId'";
    $result = mysqli_query($conShop, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Update quantity
        $updateQuery = "UPDATE shoppingcart SET Quantity = '$quantity' WHERE ShoppingCartId = '$cartId'";
        if (mysqli_query($conShop, $updateQuery)) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Database error']);
        }
    } else {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
}
?>