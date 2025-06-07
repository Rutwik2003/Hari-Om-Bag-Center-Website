<?php
session_start();
require_once("connection/conn.php");

if (!isset($_SESSION['loggedInUserId'])) {
    http_response_code(401);
    exit('Not logged in');
}

if (!isset($_POST['product_id']) || !isset($_POST['action'])) {
    http_response_code(400);
    exit('Missing parameters');
}

$userId = $_SESSION['loggedInUserId'];
$productId = $_POST['product_id'];
$action = $_POST['action'];

if ($action === 'like') {
    mysqli_query($conShop, "INSERT INTO liked_products (user_id, product_id) 
        VALUES ($userId, $productId)");
} else {
    mysqli_query($conShop, "DELETE FROM liked_products 
        WHERE user_id = $userId AND product_id = $productId");
}

echo json_encode(['success' => true]);