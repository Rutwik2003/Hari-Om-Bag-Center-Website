<!DOCTYPE html>
<html lang='en'>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
require_once('connection/conn.php');
session_start();
$ProductId = "";  // default value
if (isset($_GET['ProductId'])) {
    $ProductId = $_GET['ProductId'];
    // rest of your code...
}
?>

<head>
    <title>Zay Shop - Product Detail Page</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel='apple-touch-icon' href='assets/img/apple-icon.png'>
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico'>

    <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
    <link rel='stylesheet' href='assets/css/templatemo.css'>
    <link rel='stylesheet' href='assets/css/custom.css'>

    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap'>
    <link rel='stylesheet' href='assets/css/fontawesome.min.css'>

    <link rel='stylesheet' type='text/css' href='assets/css/slick.min.css'>
    <link rel='stylesheet' type='text/css' href='assets/css/slick-theme.css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .checked {
            color: orange;
        }
    </style>

</head>

<body>

    <!-- Header -->
    <nav class='navbar navbar-expand-lg navbar-light shadow'>
        <div class='container d-flex justify-content-between align-items-center'>

            <a class='navbar-brand text-success logo h1 align-self-center' href='index.php' style='margin-right: 5% ;'>
                Zay
            </a>

            <button class='navbar-toggler border-0' type='button' data-bs-toggle='collapse' data-bs-target='#templatemo_main_nav' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="formpage.php">Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="job.php">Work with us</a>
                        </li>
                    </ul>
                </div>
                <div class='navbar align-self-center d-flex'>



                    <div style='padding-left: 30px; padding-right: 5px; padding-bottom:5px; padding-top: 5px '>
                        <?php
                        if (!isset($_SESSION['usernamelogin'])) {
                            echo "  <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \" href=login.php>Login</a>";
                            echo " <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=register.php>Sign Up</a>";
                        } else {

                            echo " <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=createads.php>Add advertisement</a>";

                            echo " <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=myAccountInfos.php>My account</a>";
                        }


                        ?>
                    </div>
                </div>
            </div>
        </div>

    </nav>
    <!-- Close Header -->
    <?php
    if (!isset($_SESSION['usernamelogin'])) {
    } else {
        echo "<br>";
        echo "<h2 style=\"color: #04aa6d; margin-left:15%;  allign:centre\">Welcome, " . $_SESSION['usernamelogin'] . "</h2>";
    }


    ?>


    <!-- Modal -->
    <div class='modal fade bg-white' id='templatemo_search' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg' role='document'>
            <div class='w-100 pt-1 mb-5 text-right'>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <form action='' method='get' class='modal-content modal-body border-0 p-0'>
                <div class='input-group mb-2'>
                    <input type='text' class='form-control' id='inputModalSearch' name='q' placeholder='Search ...'>
                    <button type='submit' class='input-group-text bg-success text-light'>
                        <i class='fa fa-fw fa-search text-white'></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <?php

    // if(isset($_GET['ProductId'])){
    //     $ProductId = $_GET['ProductId'];
    //     $Products=mysqli_query($conShop, "SELECT * FROM products WHERE ProductId = ". $ProductId);
    //     $product =mysqli_fetch_array($Products);
    // }
    if (isset($_GET['ProductId'])) {
        $ProductId = $_GET['ProductId'];
        $Products = mysqli_query($conShop, "SELECT * FROM products WHERE ProductId = " . $ProductId);
        $product = mysqli_fetch_array($Products);
        echo "

    <!-- Open Content -->
    <form method='post' action='addtocart.php'>
    <section class='bg-light'>
    <input type='hidden' name='ProductId' id='ProductId' value='$ProductId'>
    <input type='hidden' name='priceofone' id='ProductId' value='$product[Price]'>
        <div class='container pb-5'>
            <div class='row'>
                <div class='col-lg-5 mt-5'>
                    <div class='card mb-3'>
                        <img class='card-img img-fluid' src='$product[ImgPath]' alt='Card image cap' id='product-detail'>
                    </div>
                    <div class='row'>
                        <!--Start Controls-->
                        <div class='col-1 align-self-center'>
                            <a href='#multi-item-example' role='button' data-bs-slide='prev'>
                                <i class='text-dark fas fa-chevron-left'></i>
                                <span class='sr-only'>Previous</span>
                            </a>
                        </div>
                        <!--End Controls-->
                        <!--Start Carousel Wrapper-->
                        <div id='multi-item-example' class='col-10 carousel slide carousel-multi-item' data-bs-ride='carousel'>
                            <!--Start Slides-->
                            <div class='carousel-inner product-links-wap' role='listbox'>

                                <!--First slide-->
                                <div class='carousel-item active'>
                                    <div class='row'>
                                        <div class='col-4'>
                                            <a href='#'>
                                                <img class='card-img img-fluid' src='$product[ImgPath]' alt='Product Image 1'>
                                            </a>
                                        </div>
                                        <div class='col-4'>
                                            <a href='#'>
                                                <img class='card-img img-fluid' src='$product[ImgPath]' alt='Product Image 2'>
                                            </a>
                                        </div>
                                        <div class='col-4'>
                                            <a href='#'>
                                                <img class='card-img img-fluid' src='$product[ImgPath]' alt='Product Image 3'>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--/.First slide-->

                                <!--Second slide-->
                                <div class='carousel-item'>
                                    <div class='row'>
                                        <div class='col-4'>
                                            <a href='#'>
                                                <img class='card-img img-fluid' src='$product[ImgPath]' alt='Product Image 4'>
                                            </a>
                                        </div>
                                        <div class='col-4'>
                                            <a href='#'>
                                                <img class='card-img img-fluid' src='$product[ImgPath]' alt='Product Image 5'>
                                            </a>
                                        </div>
                                        <div class='col-4'>
                                            <a href='#'>
                                                <img class='card-img img-fluid' src='$product[ImgPath]' alt='Product Image 6'>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--/.Second slide-->

                                <!--Third slide-->
                                <div class='carousel-item'>
                                    <div class='row'>
                                        <div class='col-4'>
                                            <a href='#'>
                                                <img class='card-img img-fluid' src='$product[ImgPath]' alt='Product Image 7'>
                                            </a>
                                        </div>
                                        <div class='col-4'>
                                            <a href='#'>
                                                <img class='card-img img-fluid' src='$product[ImgPath]' alt='Product Image 8'>
                                            </a>
                                        </div>
                                        <div class='col-4'>
                                            <a href='#'>
                                                <img class='card-img img-fluid' src='$product[ImgPath]' alt='Product Image 9'>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--/.Third slide-->
                            </div>
                            <!--End Slides-->
                        </div>
                        <!--End Carousel Wrapper-->
                        <!--Start Controls-->
                        <div class='col-1 align-self-center'>
                            <a href='#multi-item-example' role='button' data-bs-slide='next'>
                                <i class='text-dark fas fa-chevron-right'></i>
                                <span class='sr-only'>Next</span>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
                <!-- col end -->
                <div class='col-lg-7 mt-5'>
                    <div class='card'>
                        <div class='card-body'>
                            <h1 class='h2'>$product[Title]</h1>
                            <p class='h3 py-2'>$$product[Price]</p>
                            <p class='py-2'>";

        $rating = $product['Rating'];
        $emptyStart = 5 - $rating;
        $counter = 5;
        while ($counter > 0) {
            if ($rating > 0) {
                echo "<span class='fa fa-star checked'></span>";
                $rating = $rating - 1;
            } else {
                echo "<span class='fa fa-star'></span>";
            }
            $counter = $counter - 1;
        }

        echo "
                                <span class='list-inline-item text-dark'>Rating</span>
                            </p>
                            <ul class='list-inline'>
                                <li class='list-inline-item'>
                                    <h6>Brand:</h6>
                                </li>
                                <li class='list-inline-item'>
                                    <p class='text-muted'><strong>$product[Brand]</strong></p>
                                </li>
                            </ul>

                            <h6>Description:</h6>
                            <p>$product[Description]</p>
                            <ul class='list-inline'>
                                <li class='list-inline-item'>
                                    <h6>Avaliable Color :</h6>
                                </li>
                                <li class='list-inline-item'>
                                    <p class='text-muted'><strong>White / Black</strong></p>
                                </li>
                            </ul>

                            <h6>Specification:</h6>
                            <ul class='list-unstyled pb-3'>
                            $product[Specification]
                            </ul>

                            <form action='' method='GET'>   
                                <input type='hidden' name='product-title' value='Activewear'>
                                <div class='row'>
                                    <div class='col-auto'>
                                        <ul class='list-inline pb-3'>
                                            <li class='list-inline-item'>Size :
                                                <input type='hidden' name='product-size' id='product-size' value='$product[Size]<'>
                                            </li>
                                            <li class='list-inline-item'><span class='btn btn-success btn-size'>$product[Size]</span></li>
                                        </ul>
                                    </div>
                                    <div class='col-auto'>
                                        <ul class='list-inline pb-3'>
                                            <li class='list-inline-item text-right'>
                                                Quantity
                                                <input type='hidden' name='product-quanity' id='product-quanity' value='1'>
                                            </li>
                                            
                                           
                                            <input type='number' value='1' min='1' max='20' onkeydown='return false' style='width:50px;' name='quantity'>
                                       
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class='row pb-3'>
                                    <div class='col d-grid'>
                                        <button type='submit' class='btn btn-success btn-lg' name='submit' value='buy'>Buy</button>
                                    </div>
                                    <div class='col d-grid'>
                                        <button type='submit' class='btn btn-success btn-lg' name='submit' value='addtocard'>Add To Cart</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
    ";
        echo "<input type='hidden' name='priceofone' id='ProductId' value='$product[Price]'>";
    }
    ?>
    <!-- Close Content -->

    <!-- Start Article -->
    <section class='py-5'>
        <div class='container'>
            <div class='row text-left p-2 pb-3'>
                <h4>Related Products</h4>
            </div>

            <!--Start Carousel Wrapper-->
            <div id='carousel-related-product'>


                <?php
                $Products = mysqli_query($conShop, "SELECT * FROM products");

                while ($rowProducts = mysqli_fetch_array($Products)) {
                    if ($rowProducts["IsAvailable"] == "AVAILABLE" && $rowProducts["ProductId"] != $ProductId) {
                        $rating = $rowProducts["Rating"];
                        echo "
            
                <div class='p-2 pb-3'>
                    <div class='product-wap card rounded-0'>
                        <div class='card rounded-0'>
                            <img class='card-img rounded-0 img-fluid' src='$rowProducts[ImgPath]'>
                            <div class='card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center'>
                                <ul class='list-unstyled'>
                                    <li><a class='btn btn-success text-white' href='shop-single.php?productId=$rowProducts[ProductId]'><i class='far fa-heart'></i></a></li>
                                    <li><a class='btn btn-success text-white mt-2' href='shop-single.php?productId=$rowProducts[ProductId]'><i class='far fa-eye'></i></a></li>
                                    <li><a class='btn btn-success text-white mt-2' href='shop-single.php?productId=$rowProducts[ProductId]'><i class='fas fa-cart-plus'></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class='card-body'>
                            <a href='shop-single.php?productId=$rowProducts[ProductId]' class='h3 text-decoration-none'>$rowProducts[Title]</a>
                            <ul class='w-100 list-unstyled d-flex justify-content-between mb-0'>
                                <li>$rowProducts[Size]</li>
                                <li class='pt-2'>
                                    <span class='product-color-dot color-dot-red float-left rounded-circle ml-1'></span>
                                    <span class='product-color-dot color-dot-blue float-left rounded-circle ml-1'></span>
                                    <span class='product-color-dot color-dot-black float-left rounded-circle ml-1'></span>
                                    <span class='product-color-dot color-dot-light float-left rounded-circle ml-1'></span>
                                    <span class='product-color-dot color-dot-green float-left rounded-circle ml-1'></span>
                                </li>
                            </ul>
                            <ul class='list-unstyled d-flex justify-content-center mb-1'>
                                <li>
                                ";

                        $emptyStart = 5 - $rating;
                        $counter = 5;
                        while ($counter > 0) {
                            if ($rating > 0) {
                                echo " <span class='fa fa-star checked'></span>";
                                $rating = $rating - 1;
                            } else {
                                echo "<span class='fa fa-star'></span>";
                            }
                            $counter = $counter - 1;
                        }


                        echo "  </li>
                            </ul>
                            <p class='text-center mb-0'>$$rowProducts[Price]</p>
                        </div>
                    </div>
                </div>

                ";
                    }
                }
                ?>



            </div>


        </div>
    </section>
    <!-- End Article -->

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Hari Om Bag Center</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Opp.Hotel Sifat International Surat, Railway Station Rd, opp. Surat Railway Station, Lal Darwaja, Varachha, Surat, Gujarat 395003
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">+91 89808 75690</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Categories</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">School Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Gym Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Trolley & Duffel Bags</a></li>
                        <li><a class="text-decoration-none" href="#">laptop Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Sky Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Tiffin Bags</a></li>
                        <li><a class="text-decoration-none" href="#">Bum bags & Pooch bags</a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Home</a></li>
                        <li><a class="text-decoration-none" href="#">About Us</a></li>
                        <li><a class="text-decoration-none" href="#">Shop Locations</a></li>
                        <li><a class="text-decoration-none" href="#">FAQs</a></li>
                        <li><a class="text-decoration-none" href="#">Contact</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <!-- <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2021 Zay shop | Designed by Hawraa, Elia, Adrean, Charbel
                        </p>
                    </div> -->
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src='assets/js/jquery-1.11.0.min.js'></script>
    <script src='assets/js/jquery-migrate-1.2.1.min.js'></script>
    <script src='assets/js/bootstrap.bundle.min.js'></script>
    <script src='assets/js/templatemo.js'></script>
    <script src='assets/js/custom.js'></script>
    <!-- End Script -->

    <!-- Start Slider Script -->
    <script src='assets/js/slick.min.js'></script>
    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>
    <!-- End Slider Script -->

</body>

</html>