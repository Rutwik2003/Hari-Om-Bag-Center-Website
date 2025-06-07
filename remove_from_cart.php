<?php
require_once("connection/conn.php");
session_start();

if(isset($_POST['cartId']) && isset($_SESSION['loggedInUserId'])) {
    $cartId = mysqli_real_escape_string($conShop, $_POST['cartId']);
    $userId = $_SESSION['loggedInUserId'];
    
    $delete = mysqli_query($conShop, "DELETE FROM shoppingcart WHERE ShoppingCartId = $cartId AND clientId = $userId");
    
    if($delete) {
        echo "success";
    } else {
        http_response_code(500);
        echo "error";
    }
}
?>