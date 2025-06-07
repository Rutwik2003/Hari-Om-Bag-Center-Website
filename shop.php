<?php
require_once("connection/conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hari Om Bag Center | Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #04aa6d;
            --text-color: #333;
        }

        .shop-header {
            background: var(--primary-color);
            padding: 40px 0;
            color: white;
        }

        .categories {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .categories h3 {
            color: var(--text-color);
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .category-link {
            display: block;
            color: var(--text-color);
            padding: 8px 0;
            text-decoration: none;
            border-bottom: 1px solid #eee;
        }

        .category-link:hover {
            color: var(--primary-color);
        }

        .category-link.active {
            color: var(--primary-color);
            font-weight: bold;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .product-card {
            background: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .product-image {
            position: relative;
            padding-top: 100%;
        }

        .product-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 15px;
            text-align: center;
        }

        .product-title {
            color: var(--text-color);
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .product-price {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 15px;
        }

        .btn-add-cart {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-view {
            background: #f5f5f5;
            color: var(--text-color);
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            width: 100%;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view:hover {
            background: var(--primary-color);
            color: white;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <!-- Shop Header -->
    <div class="shop-header py-5">
        <div class="container">
            <h1 class="display-4 mb-4">Shop Collection</h1>
            <div class="search-container">
                <form action="shop.php" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control form-control-lg" placeholder="Search products..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="btn btn-light ms-2"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <nav class="mt-3">
                <a href="index.php" class="text-white text-decoration-none">Home</a>
                <span class="text-white mx-2">/</span>
                <span class="text-white">Shop</span>
            </nav>
        </div>
    </div>

    <style>
        .shop-header {
            background: #04aa6d;
            color: #fff;
            padding: 60px 0;
        }
        
        .search-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .search-container input {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            padding: 15px 25px;
        }
        
        .search-container button {
            padding: 0 25px;
            font-size: 1.2rem;
        }
        
        .search-container button:hover {
            background: rgba(255, 255, 255, 0.8);
        }
    </style>
        <div class="breadcrumb-nav bg-light rounded p-3">
            <a href="index.php" class="text-dark text-decoration-none">Home</a>
            <span class="mx-2">/</span>
            <span>Shop</span>
        </div>
    </div>

    <style>
        .shop-header {
            background: #04aa6d;
            color: #fff;
        }
        
        .breadcrumb-nav {
            background: rgba(255, 255, 255, 0.9) !important;
        }
        
        .breadcrumb-nav a:hover {
            color: #04aa6d !important;
        }
        
        .display-4 {
            font-weight: 300;
            font-size: 3.5rem;
        }
    </style>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories mb-4">
                    <h3>Categories</h3>
                    <a href="shop.php" class="category-link">All Products</a>
                    <?php
                    // Define categories array with ID => Name mapping
                    $categories = [
                        1 => 'Handbags',
                        2 => 'Backpacks',
                        3 => 'Sling Bags',
                        4 => 'Laptop Bags',
                        5 => 'Sweather',
                        6 => 'Wallets',
                        7 => 'Travel Bags',
                        8 => 'School Bags',
                        9 => 'Gym Bags',
                        10 => 'Messenger Bags'
                    ];
                    
                    foreach($categories as $id => $name) {
                        $activeClass = (isset($_GET['category']) && $_GET['category'] == $id) ? 'active' : '';
                        echo '<a href="?category=' . $id . '" class="category-link ' . $activeClass . '">' . 
                            htmlspecialchars($name) . '</a>';
                    }
                    ?>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>All Products</h2>
                    <select class="form-select" id="sortProducts" name="sort" style="width: auto;">
                        <option value="featured">Featured</option>
                        <option value="low-to-high">Price: Low to High</option>
                        <option value="high-to-low">Price: High to Low</option>
                    </select>
                </div>

                <div class="product-grid">
                    <?php
                    $where = "";
                    if(isset($_GET['search'])) {
                        $search = mysqli_real_escape_string($conShop, $_GET['search']);
                        $where = "WHERE Title LIKE '%$search%' OR Description LIKE '%$search%'";
                    } elseif(isset($_GET['category'])) {
                        $categoryId = mysqli_real_escape_string($conShop, $_GET['category']);
                        $where = "WHERE Categories = '$categoryId'";
                    }
                    
                    $orderBy = "";
                    if(isset($_GET['sort'])) {
                        switch($_GET['sort']) {
                            case 'low-to-high':
                                $orderBy = "ORDER BY Price ASC";
                                break;
                            case 'high-to-low':
                                $orderBy = "ORDER BY Price DESC";
                                break;
                            default:
                                $orderBy = "ORDER BY ProductId DESC";
                        }
                    }
                    
                    $products = mysqli_query($conShop, "SELECT * FROM products $where $orderBy");
                    
                    while($product = mysqli_fetch_array($products)): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo $product['ImgPath']; ?>" alt="<?php echo $product['Title']; ?>">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><?php echo $product['Title']; ?></h3>
                            <div class="product-price">₹<?php echo number_format($product['Price'], 2); ?></div>
                            <button class="btn-add-cart add-to-cart" data-product-id="<?php echo $product['ProductId']; ?>">
                                Add to Cart
                            </button>
                            <a href="shop-single.php?productId=<?php echo $product['ProductId']; ?>" class="btn-view">
                                View Details
                            </a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                var productId = $(this).data('product-id');
                $.ajax({
                    type: "POST",
                    url: "addtocart.php",
                    data: {
                        ProductId: productId,
                        quantity: 1,
                        submit: 'addtocard'
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function() {
                        alert('Error adding product to cart');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#sortProducts').change(function() {
                var currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('sort', $(this).val());
                window.location.href = currentUrl.toString();
            });

            // Set selected option based on URL parameter
            var urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('sort')) {
                $('#sortProducts').val(urlParams.get('sort'));
            }
        });
    </script>
</body>
</html>