<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("connection/conn.php");
session_start();
?>

<head>
    <title>Hari Om Bag Center</title>
    <style>
        .carousel-item {
            height: 500px;
        }
        .carousel-item img {
            height: 400px;
            object-fit: contain;
        }
    </style>
</head>


<body>
    <?php include 'header.php'; ?>

    <?php if (isset($_SESSION['usernamelogin'])): ?>
        <div class="container mt-3">
            <div class="welcome-message" id="welcomeMessage">
                <h2 class="mb-0">Welcome, <?php echo $_SESSION['usernamelogin']; ?></h2>
            </div>
        </div>
    <?php endif; ?>

    <!-- Banner Carousel -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <style>
                .carousel-item {
                    height: 500px; /* Fixed height for all carousel items */
                }
                .carousel-item img {
                    height: 400px; /* Fixed height for all images */
                    object-fit: contain; /* This ensures images maintain aspect ratio */
                }
            </style>
            <div class="carousel-item active">
                <div class="container h-100"> <!-- Added h-100 for full height -->
                    <div class="row p-5 h-100"> <!-- Added h-100 for full height -->
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_img_01.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>Hari Om Bag Center</b> eCommerce</h1>
                                <p>
                                    Hari Om Bag Center offers a curated selection of stylish and durable bags. From trendy backpacks to professional office bags, we provide quality options for every occasion.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="ProductImages/1 (17).jpeg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Travel Bag</h1>
                                <p>
                                    "Embark on adventures, your trusty travel bag in tow, and create memories that last a lifetime."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="ProductImages\1 (3).jpeg    " alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Mini Bag </h1>
                                <p>
                                    "Small in size, big on style - the perfect mini bag for boys on the go."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Shop Section -->
    <div class="container py-5" id="shop_section">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <?php if (isset($_SESSION['loggedInUserId'])): ?>
                    <!-- Cart Summary -->
                    <?php
                    $cartQuery = mysqli_query($conShop, "SELECT COUNT(ShoppingCartId) as TotalQuantity FROM shoppingcart WHERE clientId=$_SESSION[loggedInUserId]");
                    $cartData = mysqli_fetch_array($cartQuery);
                    ?>
                    <div class="card mb-4 border-success">
                        <div class="card-body">
                            <h5 class="card-title text-success">Shopping Cart</h5>
                            <p class="card-text">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge bg-success"><?php echo $cartData['TotalQuantity']; ?></span> items
                            </p>
                            <div class="d-grid gap-2">
                                <a href="ShoppingCart.php" class="btn btn-success btn-sm">View Cart</a>
                                <a href="Orders.php" class="btn btn-outline-success btn-sm">My Orders</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Categories -->
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Categories</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <?php
                            $categories = mysqli_query($con, "SELECT * FROM categories");
                            while ($category = mysqli_fetch_array($categories)) {
                                echo "<li class='mb-2'><a href='shop.php?categoryId={$category['CategoryID']}' 
                                    class='text-decoration-none text-dark'>{$category['CategoryName']}</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <?php
                // Number of products per page
                $products_per_page = 6;
                
                // Get current page
                $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($current_page - 1) * $products_per_page;
                
                // Base query
                $query = "SELECT * FROM products WHERE IsAvailable = 'AVAILABLE'";
                if (isset($_GET['Specification'])) {
                    $query .= " AND Specification='$_GET[Specification]'";
                } elseif (isset($_GET['Brand'])) {
                    $query .= " AND Brand='$_GET[Brand]'";
                }
                
                // Get total products count
                $total_products_result = mysqli_query($conShop, $query);
                $total_products = mysqli_num_rows($total_products_result);
                $total_pages = ceil($total_products / $products_per_page);
                
                // Add pagination to query
                $query .= " LIMIT $offset, $products_per_page";
                $Products = mysqli_query($conShop, $query);
                ?>

                <div class="row g-4">
                    <?php while ($product = mysqli_fetch_array($Products)) {
                        echo "
                        <div class='col-md-4'>
                            <div class='card h-100 product-card'>
                                <img src='{$product['ImgPath']}' class='card-img-top' alt='{$product['Title']}'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$product['Title']}</h5>
                                    <p class='card-text text-muted mb-2'>" . 
                                        (strlen($product['Description']) > 10 ? 
                                        substr($product['Description'], 0, 30) . '...' : 
                                        $product['Description']) . 
                                    "</p>
                                    <p class='card-text'>
                                        <span class='text-success fw-bold'>₹{$product['Price']}</span>
                                    </p>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <div class='rating'>";
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo $i <= $product['Rating'] 
                                                ? "<i class='fas fa-star text-warning'></i>" 
                                                : "<i class='far fa-star text-warning'></i>";
                                        }
                        echo "
                                        </div>
                                        <a href='shop-single.php?productId={$product['ProductId']}' 
                                            class='btn btn-success btn-sm'>View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                    ?>
                </div>
                
                <!-- Products Pagination -->
                <div class="row mt-5">
                    <div class="col-12">
                        <nav aria-label="Product pages">
                            <ul class="pagination justify-content-center">
                                <?php if($current_page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link text-success" href="?page=<?php echo $current_page - 1; ?>">&laquo;</a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo $i === $current_page ? 'active' : ''; ?>">
                                        <a class="page-link <?php echo $i === $current_page ? 'bg-success border-success' : 'text-success'; ?>" 
                                           href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <?php if($current_page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link text-success" href="?page=<?php echo $current_page + 1; ?>">&raquo;</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Brands Section -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Our Brands</h1>
                    <p>
                        Discover our collection of premium bag brands, each chosen for their quality, style, and durability.
                    </p>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                    

                        <!--Carousel Wrapper-->
                        
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_01.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_02.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_03.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_04.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                            
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->


    <!-- Start Footer -->
    <?php include_once("footer.php"); ?>
    <!-- End Footer -->

    <?php // include_once("footer.php"); 
    ?>
    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
    <script>
        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();

                var target = this.hash;
                var $target = $(target);

                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top
                }, 900, 'swing', function() {
                    window.location.hash = target;
                });
            });
        });

        function toggleDropdown(id) {
            var dropdown = document.getElementById(id);
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }

        // Welcome message fade out
        document.addEventListener('DOMContentLoaded', function() {
            const welcomeMessage = document.getElementById('welcomeMessage');
            if (welcomeMessage) {
                setTimeout(function() {
                    welcomeMessage.style.transition = 'opacity 1s';
                    welcomeMessage.style.opacity = '0';
                    setTimeout(function() {
                        welcomeMessage.style.display = 'none';
                    }, 1000);
                }, 3000);
            }
        });
    </script>
</body>

</html>