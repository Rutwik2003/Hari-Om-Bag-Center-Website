<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom-theme.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .badge {
            border-radius: 50%;
            font-size: 0.75rem;
            padding: 0.25em 0.6em;
        }
        .btn-spacing {
            margin-right: 10px; /* Add margin to space out buttons */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow sticky-top bg-white">
        <div class="container">
            <a class="navbar-brand text-success h1" href="index.php">Hari Om Bag Centre</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="formpage.php">Feedback</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <?php if (!isset($_SESSION['usernamelogin'])): ?>
                        <a class="btn btn-success btn-sm btn-spacing" href="login.php">Login</a>
                        <a class="btn btn-outline-success btn-sm btn-spacing" href="register.php">Sign Up</a>
                        <a class="btn btn-success btn-sm" href="admin/login.php">Admin Login</a>
                    <?php else: ?>
                        <a class="btn btn-success btn-sm btn-spacing" href="ShoppingCart.php">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                                <span class="badge bg-light text-dark ms-1"><?php echo count($_SESSION['cart']); ?></span>
                            <?php endif; ?>
                        </a>
                        <a class="btn btn-success btn-sm" href="myAccountInfos.php">My Account</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>