<?php
require_once('connection/conn.php');
session_start();

if (isset($_GET['productId'])) {
    $ProductId = $_GET['productId'];
    $Products = mysqli_query($conShop, "SELECT * FROM products WHERE ProductId = " . $ProductId);
    $product = mysqli_fetch_array($Products);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hari Om Bag Center - <?php echo $product['Title']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
    
    <style>
        .product-gallery {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.08);
        }
        .product-details {
            padding: 30px;
        }
        .product-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }
        .product-price {
            font-size: 1.8rem;
            color: #04aa6d;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .product-description {
            color: #666;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        .product-meta {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .quantity-input {
            width: 100px;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            text-align: center;
        }
        .btn-action {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-action:hover {
            transform: translateY(-2px);
        }
        .related-products {
            padding: 60px 0;
            background: #f8f9fa;
        }
        .related-product-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }
        .related-product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.12);
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <!-- Breadcrumb -->
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $product['Title']; ?></li>
            </ol>
        </nav>
    </div>

    <!-- Product Details Section -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-gallery">
                    <img src="<?php echo $product['ImgPath']; ?>" class="img-fluid" alt="<?php echo $product['Title']; ?>">
                    <div class="row mt-3">
                        <div class="col-3">
                            <img src="<?php echo $product['ImgPath']; ?>" class="img-fluid" alt="Thumbnail">
                        </div>
                        <!-- Add more thumbnails if available -->
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="product-details">
                    <h1 class="product-title"><?php echo $product['Title']; ?></h1>
                    <div class="product-price">₹<?php echo number_format($product['Price'], 2); ?></div>
                    
                    <div class="product-meta">
                        <p><strong>Brand:</strong> <?php echo $product['Brand']; ?></p>
                        <p><strong>Availability:</strong> In Stock</p>
                        <p><strong>Size:</strong> <?php echo $product['Size']; ?></p>
                    </div>

                    <div class="product-description">
                        <?php echo $product['Description']; ?>
                    </div>

                    <form action="addtocart.php" method="POST">
                        <input type="hidden" name="ProductId" value="<?php echo $ProductId; ?>">
                        <div class="row align-items-center mb-4">
                            <div class="col-auto">
                                <label class="me-3">Quantity:</label>
                                <input type="number" name="quantity" value="1" min="1" max="20" class="quantity-input">
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex">
                            <button type="submit" name="submit" value="buy" class="btn btn-success btn-action flex-fill">Buy Now</button>
                            <button type="submit" name="submit" value="addtocard" class="btn btn-outline-success btn-action flex-fill">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <section class="related-products">
        <div class="container">
            <h3 class="mb-4">Related Products</h3>
            <div class="row g-4">
                <?php
                $relatedProducts = mysqli_query($conShop, "SELECT * FROM products WHERE ProductId != $ProductId LIMIT 4");
                while ($related = mysqli_fetch_array($relatedProducts)) {
                    echo '
                    <div class="col-md-3">
                        <div class="related-product-card">
                            <img src="'.$related['ImgPath'].'" class="img-fluid" alt="'.$related['Title'].'">
                            <div class="p-3">
                                <h5>'.$related['Title'].'</h5>
                                <p class="text-success fw-bold">₹'.number_format($related['Price'], 2).'</p>
                                <a href="shop-single.php?productId='.$related['ProductId'].'" class="btn btn-sm btn-outline-success w-100">View Details</a>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
</body>
</html>