<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - Hari Om Bag Center</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom-theme.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <style>
        .checkout-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
        }
        .order-card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .order-header {
            background: linear-gradient(45deg, #04aa6d, #038857);
            padding: 20px;
            color: white;
        }
        .order-table {
            margin: 0;
        }
        .order-table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        .order-table td, .order-table th {
            padding: 15px;
        }
        .total-row {
            background-color: #f8f9fa;
            font-size: 1.1em;
        }
        .pay-button {
            background: linear-gradient(45deg, #04aa6d, #038857);
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            transition: all 0.3s ease;
        }
        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .success-message {
            background-color: #d4edda;
            border-left: 5px solid #04aa6d;
            margin: 20px 0;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
    require_once("connection/conn.php");
    session_start();

    // Add the missing function
    function generateRandomString($length = 50) {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Razorpay configuration
    $keyId = 'rzp_test_gAMdkydxL1c4qj';

    // Get cart total
    $cart = mysqli_query($conShop, "SELECT sc.*, p.Title, p.Price 
        FROM shoppingcart sc 
        JOIN products p ON sc.ProductId = p.ProductId 
        WHERE sc.clientId = $_SESSION[loggedInUserId]");

    $total_amount = 0;
    while($row = mysqli_fetch_array($cart)) {
        $total_amount += ($row['Price'] * $row['Quantity']);
    }
    ?>

    <div class="checkout-container">
        <div class="row">
            <div class="col-lg-8">
                <div class="order-card mb-4">
                    <div class="order-header">
                        <h3 class="m-0"><i class="fa fa-shopping-cart me-2"></i>Order Summary</h3>
                    </div>
                    <div class="card-body">
                        <table class="table order-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                mysqli_data_seek($cart, 0);
                                while($item = mysqli_fetch_array($cart)) {
                                    echo "<tr>
                                        <td><strong>{$item['Title']}</strong></td>
                                        <td class='text-center'>{$item['Quantity']}</td>
                                        <td class='text-end'>₹" . number_format($item['Price'] * $item['Quantity'], 2) . "</td>
                                    </tr>";
                                }
                                ?>
                                <tr class="total-row">
                                    <td colspan="2"><strong>Total Amount</strong></td>
                                    <td class="text-end"><strong>₹<?php echo number_format($total_amount, 2); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="order-card">
                    <div class="order-header">
                        <h3 class="m-0"><i class="fa fa-credit-card me-2"></i>Payment</h3>
                    </div>
                    <div class="card-body">
                        <form id="payment-form" action="process_payment.php" method="POST">
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                            <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                            <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                            <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                            <button id="pay-button" class="btn btn-success btn-lg w-100 pay-button">
                                Pay Now ₹<?php echo number_format($total_amount, 2); ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (mysqli_num_rows($cart) == 0) {
            echo "<div class='container py-5'>
                <div class='alert alert-warning'>Your cart is empty!</div>
                <div class='text-center'>
                    <a href='shop.php' class='btn btn-primary'>Continue Shopping</a>
                </div>
            </div>";
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    var options = {
        "key": "<?php echo $keyId; ?>",
        "amount": "<?php echo $total_amount * 100; ?>",
        "currency": "INR",
        "name": "Hari Om Bag Center",
        "description": "Order Payment",
        "image": "assets/img/apple-icon.png",
        "handler": function (response){
            // Set payment details
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            
            // Submit form to process payment
            document.getElementById('payment-form').submit();
        },
        "prefill": {
            "name": "<?php echo $_SESSION['usernamelogin']; ?>"
        },
        "theme": {
            "color": "#04aa6d"
        }
    };
    var rzp = new Razorpay(options);
    document.getElementById('pay-button').onclick = function(e){
        e.preventDefault();
        rzp.open();
    }
    </script>