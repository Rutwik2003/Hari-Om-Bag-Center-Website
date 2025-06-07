<?php
require_once("connection/conn.php");
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['loggedInUserId'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart | Hari Om Bag Center</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .cart-header {
            background: #04aa6d;
            padding: 40px 0;
            color: white;
            margin-bottom: 30px;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0;
        }
        .breadcrumb-item a {
            color: #f8f9fa; /* Change to a lighter color for visibility */
            text-decoration: none;
        }
        .breadcrumb-item a:hover {
            color: #e0e0e0; /* Slightly darker on hover */
        }
        .breadcrumb-item.active {
            color: #f8f9fa; /* Ensure active item is visible */
        }
        .cart-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        .cart-item img {
            max-width: 120px;
            border-radius: 4px;
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .quantity-btn {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        .quantity-btn:hover {
            background: #e9ecef;
        }
        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 4px;
            font-size: 16px;
            -moz-appearance: textfield;
        }
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }
        .cart-summary {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 25px;
            position: sticky;
            top: 20px;
            transition: all 0.3s ease;
        }
        .cart-summary:hover {
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .summary-title {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        .summary-content {
            padding: 10px 0;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            color: #666;
        }
        .summary-row.total {
            border-top: 2px solid #f0f0f0;
            margin-top: 10px;
            padding-top: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }
        .shipping {
            color: #04aa6d;
            font-weight: 500;
        }
        .checkout-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background: #04aa6d;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            width: 100%;
            font-size: 1.1em;
            margin-top: 20px;
            transition: all 0.3s ease;
            text-decoration: none;
            opacity: 0.9;
        }
        .cart-summary:hover .checkout-btn {
            opacity: 1;
            transform: translateY(-2px);
        }
        .checkout-btn:hover {
            background: #038857;
            color: white;
            text-decoration: none;
        }
        .remove-btn {
            color: #dc3545;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }
        .remove-btn:hover {
            color: #c82333;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="cart-header">
        <div class="container">
            <h1 class="display-4">Shopping Cart</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" class="text-black">Home</a></li>
                    <li class="breadcrumb-item active text-black" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container pb-5">
        <?php
        $cartQuery = mysqli_query($conShop, "
            SELECT sc.*, p.Price as ProductPrice, p.Title, p.ImgPath 
            FROM shoppingcart sc 
            JOIN products p ON sc.ProductId = p.ProductId 
            WHERE sc.clientId = $_SESSION[loggedInUserId]
        ");

        if (mysqli_num_rows($cartQuery) > 0) {
            $totalAmount = 0;
            ?>
            <div class="row">
                <div class="col-lg-8">
                    <?php
                    while ($item = mysqli_fetch_array($cartQuery)) {
                        $itemTotal = $item['Quantity'] * $item['ProductPrice'];
                        $totalAmount += $itemTotal;
                        ?>
                        <div class="cart-item">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="<?php echo $item['ImgPath']; ?>" class="img-fluid" alt="<?php echo $item['Title']; ?>">
                                </div>
                                <div class="col-md-4">
                                    <h5><?php echo $item['Title']; ?></h5>
                                    <p class="text-muted">₹<?php echo number_format($item['ProductPrice'], 2); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="quantity-control">
                                        <button class="quantity-btn update-quantity" data-cart-id="<?php echo $item['ShoppingCartId']; ?>" data-action="decrease">−</button>
                                        <input type="number" class="quantity-input" value="<?php echo $item['Quantity']; ?>" min="1" data-cart-id="<?php echo $item['ShoppingCartId']; ?>" readonly>
                                        <button class="quantity-btn update-quantity" data-cart-id="<?php echo $item['ShoppingCartId']; ?>" data-action="increase">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <h6>₹<?php echo number_format($itemTotal, 2); ?></h6>
                                </div>
                                <div class="col-md-1">
                                    <button class="remove-btn" onclick="removeItem(<?php echo $item['ShoppingCartId']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h4 class="summary-title">Cart Summary</h4>
                        <div class="summary-content">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span class="amount">₹<?php echo number_format($totalAmount, 2); ?></span>
                            </div>
                            <div class="summary-row">
                                <span>Shipping</span>
                                <span class="shipping">Free</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total</span>
                                <span class="amount">₹<?php echo number_format($totalAmount, 2); ?></span>
                            </div>
                            <a href="checkout.php" class="checkout-btn">
                                <span>Proceed to Checkout</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "<div class='text-center py-5'>
                <h3>Your cart is empty</h3>
                <p class='text-muted'>Looks like you haven't added anything to your cart yet.</p>
                <a href='shop.php' class='btn btn-success mt-3'>Continue Shopping</a>
            </div>";
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        function removeItem(cartId) {
            if(confirm('Are you sure you want to remove this item?')) {
                $.ajax({
                    type: 'POST',
                    url: 'remove_from_cart.php',
                    data: { cartId: cartId },
                    success: function(response) {
                        // Remove the cart item element from DOM
                        $(`[data-cart-id="${cartId}"]`).closest('.cart-item').fadeOut(300, function() {
                            $(this).remove();
                            // Recalculate total
                            updateCartTotal();
                            // If no items left, show empty cart message
                            if($('.cart-item').length === 0) {
                                $('.row').html("<div class='text-center py-5'>" +
                                    "<h3>Your cart is empty</h3>" +
                                    "<p class='text-muted'>Looks like you haven't added anything to your cart yet.</p>" +
                                    "<a href='shop.php' class='btn btn-success mt-3'>Continue Shopping</a>" +
                                    "</div>");
                            }
                        });
                    },
                    error: function() {
                        alert('Error removing item from cart');
                    }
                });
            }
        }

        $(document).ready(function() {
            // Handle quantity update buttons (+ and -)
            $('.update-quantity').click(function() {
                const cartId = $(this).data('cart-id');
                const action = $(this).data('action');
                const input = $(this).siblings('.quantity-input');
                let quantity = parseInt(input.val());
                
                if(action === 'increase') {
                    quantity++;
                } else if(action === 'decrease' && quantity > 1) {
                    quantity--;
                }
                
                updateCartQuantity(cartId, quantity);
            });
            
            // Handle direct quantity input changes
            $('.quantity-input').change(function() {
                const cartId = $(this).data('cart-id');
                const quantity = parseInt($(this).val());
                if(quantity >= 1) {
                    updateCartQuantity(cartId, quantity);
                }
            });
            
            // Function to update cart quantity via AJAX
            function updateCartQuantity(cartId, quantity) {
                $.ajax({
                    type: 'POST',
                    url: 'update_cart.php',
                    data: {
                        cartId: cartId,
                        quantity: quantity
                    },
                    success: function(response) {
                        // Update the quantity input
                        $(`[data-cart-id="${cartId}"]`).val(quantity);
                        
                        // Update the item total
                        const itemPrice = parseFloat($(`[data-cart-id="${cartId}"]`).closest('.cart-item').find('.text-muted').text().replace('₹', '').replace(',', ''));
                        const newTotal = (itemPrice * quantity).toLocaleString('en-IN', {
                            maximumFractionDigits: 2,
                            minimumFractionDigits: 2
                        });
                        $(`[data-cart-id="${cartId}"]`).closest('.cart-item').find('h6').text('₹' + newTotal);
                        
                        // Update cart total
                        updateCartTotal();
                    },
                    error: function() {
                        alert('Error updating cart');
                    }
                });
            }
            
            // Function to update cart totals
            function updateCartTotal() {
                let total = 0;
                $('.cart-item').each(function() {
                    const price = parseFloat($(this).find('.text-muted').text().replace('₹', '').replace(',', ''));
                    const quantity = parseInt($(this).find('.quantity-input').val());
                    total += price * quantity;
                });
                
                const formattedTotal = total.toLocaleString('en-IN', {
                    maximumFractionDigits: 2,
                    minimumFractionDigits: 2
                });
                
                $('.summary-row .amount').text('₹' + formattedTotal);
            }
        });
    </script>
</body>
</html>