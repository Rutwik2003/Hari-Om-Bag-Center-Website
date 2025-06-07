<?php
require_once("connection/conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hari Om Bag Center | Contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" crossorigin="">
    <style>
        .contact-hero {
            background: linear-gradient(135deg, #04aa6d, #038857);
            padding: 80px 0;
            color: white;
            margin-bottom: 50px;
        }
        .contact-info-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 30px;
            height: 100%;
            transition: transform 0.3s ease;
        }
        .contact-info-card:hover {
            transform: translateY(-5px);
        }
        .contact-icon {
            font-size: 2rem;
            color: #04aa6d;
            margin-bottom: 20px;
        }
        .map-container {
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin: 50px 0;
        }
        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .form-control {
            padding: 12px;
            border: 2px solid #eee;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .form-control:focus {
            border-color: #04aa6d;
            box-shadow: none;
        }
        .btn-submit {
            background: #04aa6d;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background: #038857;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="contact-hero">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Get in Touch</h1>
            <p class="lead mb-0">Have questions? We'd love to hear from you.</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="contact-info-card text-center">
                    <i class="fas fa-map-marker-alt contact-icon"></i>
                    <h4>Our Location</h4>
                    <p>123 Main Street<br>Mumbai, Maharashtra<br>India</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info-card text-center">
                    <i class="fas fa-phone contact-icon"></i>
                    <h4>Phone Number</h4>
                    <p>+91 123 456 7890<br>+91 098 765 4321</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info-card text-center">
                    <i class="fas fa-envelope contact-icon"></i>
                    <h4>Email</h4>
                    <p>info@hariombagcenter.com<br>support@hariombagcenter.com</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="contact-form">
                    <h3 class="mb-4">Send us a Message</h3>
                    <form action="process_contact.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit w-100">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="map-container">
                    <div id="mapid" style="height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" crossorigin=""></script>
    <script>
        var mymap = L.map('mapid').setView([19.0760, 72.8777], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(mymap);
        L.marker([19.0760, 72.8777]).addTo(mymap)
            .bindPopup("<b>Hari Om Bag Center</b><br>Mumbai Location").openPopup();
    </script>
</body>
</html>