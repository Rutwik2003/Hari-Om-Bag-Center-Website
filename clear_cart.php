<?php
require_once("connection/conn.php");
session_start();

if(isset($_SESSION['loggedInUserId'])) {
    mysqli_query($conShop, "DELETE FROM shoppingcart WHERE clientId = $_SESSION[loggedInUserId]");
}
?>