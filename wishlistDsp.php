<!DOCTYPE html>
<html lang="en">
<?php
require_once("connection/conn.php");
session_start();

?>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    </script>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php" style="margin-right: 5% ;">
                Hari Om Bag Center
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
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
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">


                    <div style="padding-left: 30px; padding-right: 5px; padding-bottom:5px; padding-top: 5px ">
                        <?php
                        if (!isset($_SESSION['usernamelogin'])) {
                            echo "  <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \" href=login.php>Login</a>";
                            echo " <a class=button style=\"background-color: #04aa6d; color: white;-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;margin-left: 5px; padding-left: 7px; padding-right: 7px; padding-bottom:5px; padding-top: 2px \"href=register.php>Sign Up</a>";
                        } else {
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
        echo "<h2 style=\"color: #04aa6d; margin-left:10%;  allign:centre\">Welcome, " . $_SESSION['usernamelogin'] . "</h2>";
    }


    ?>
    <!-- Close Header -->

    <section class="ads">
        <div class="container">
            <div class="row ">

                <?php

                $USERID = $_SESSION['loggedInUserId'];
                $sql = " SELECT a.* FROM advertisments a , users u, userlikead ud WHERE u.UserID = ud.userId and a.AdsID=ud.adsId AND u.userId=$USERID AND ud.likedIf1=1";
                $result = mysqli_query($con, $sql);




                if (mysqli_num_rows($result) == false) {
                    echo "No results found";
                } else {

                    while ($row = mysqli_fetch_array($result)) {

                        if ($row['status'] == 1) {
                            echo "         
			<div id='left' class='col-md-4 col-sm-6 '>
			<div class='card ' > 
			<img class='' src='assets/img/{$row['Image']}' class='card-img-top' alt='...'>
			<span class='float-left'> $ {$row['Price']}</span>
				<div class='card-body'>
				<h5 class='card-title'>{$row['Title']}</h5>
				<p class='card-text'>{$row['Details']}</p>
                <a href='pageads.php?ADS-ID={$row['AdsID']}' class='btn btn-primary '>More Details</a>
            
           
             </div> </div></div>";
                        }
                    }
                }





                ?>
            </div>
        </div>
    </section>