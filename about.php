<!DOCTYPE html>
<html lang="en">

<?php
        require_once ("connection/conn.php");
        session_start();

        ?>

<head>
    <title>Hari Om Bag Center | About Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico"> -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom-theme.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

<body>

    <!-- Header -->
    <?php include 'header.php'; ?>
    <!-- Close Header -->
<?php  
 if(!isset($_SESSION['usernamelogin'])){
    
 }
    else{
    echo "<br>";
    echo "<h2 style=\"color: #04aa6d; margin-left:10%;  allign:centre\">Welcome, ".$_SESSION['usernamelogin']."</h2>";
    }


 ?>
        
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



    <!-- About Banner -->
    <section class="bg-success py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 text-white">
                    <h1 class="display-4 fw-bold mb-4">About Us</h1>
                    <p class="lead mb-4">
                        Welcome to Hari Om Bag Center, your premier destination for quality bags and accessories...
                    </p>
                    <p class="mb-4">
                        With years of experience in the industry, we understand the diverse needs of our customers and strive to provide products that exceed their expectations. From school bags to travel accessories, we have something for everyone.
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="assets/img/about-hero.svg" alt="About Hero" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="container py-5">
        <div class="row text-center pt-5 pb-3">
            <div class="col-lg-6 m-auto">
                <h2 class="h2 text-success">Why Choose Us</h2>
                <p class="text-muted">Experience the perfect blend of quality, style, and customer service</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 pb-5">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="h1 text-success mb-3"><i class="fas fa-award"></i></div>
                        <h3 class="h5">Quality Products</h3>
                        <p class="text-muted">Premium materials and craftsmanship in every product</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 pb-5">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="h1 text-success mb-3"><i class="fas fa-truck"></i></div>
                        <h3 class="h5">Fast Delivery</h3>
                        <p class="text-muted">Quick and reliable shipping to your doorstep</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 pb-5">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="h1 text-success mb-3"><i class="fas fa-user-shield"></i></div>
                        <h3 class="h5">Customer Support</h3>
                        <p class="text-muted">Dedicated team for all your queries and concerns</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 pb-5">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="h1 text-success mb-3"><i class="fas fa-sync"></i></div>
                        <h3 class="h5">Easy Returns</h3>
                        <p class="text-muted">Hassle-free return policy for your peace of mind</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Our Brands</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        Lorem ipsum dolor sit amet.
                    </p>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="prev">
                                <i class="text-light fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="templatemo-slide-brand" data-bs-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">

                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/skybag.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/american_tour_bag.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_03.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/adidaslogo.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End First slide-->

                                    <!--Second slide-->
                                    <div class="carousel-item">
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
                                    <!--End Second slide-->

                                    <!--Third slide-->
                                    <div class="carousel-item">
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
                                    <!--End Third slide-->

                                </div>
                                <!--End Slides-->
                            </div>
                        </div>
                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="next">
                                <i class="text-light fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->

<?php include_once("footer.php"); ?>
    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>


