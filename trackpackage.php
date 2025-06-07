<?php
require_once("connection/conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Track Package | Hari Om Bag Center</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .tracking-header {
            background: #04aa6d;
            padding: 60px 0;
            color: white;
            margin-bottom: 40px;
        }

        .tracking-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .tracking-timeline {
            position: relative;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }

        .timeline-item {
            padding: 20px;
            border-left: 2px solid #04aa6d;
            position: relative;
            margin-bottom: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -9px;
            top: 24px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #04aa6d;
        }

        .timeline-date {
            color: #666;
            font-size: 0.9rem;
        }

        .timeline-status {
            font-weight: bold;
            color: #04aa6d;
            margin: 5px 0;
        }

        .timeline-location {
            color: #333;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="tracking-header">
        <div class="container text-center">
            <h1 class="display-4">Track Your Package</h1>
            <p class="lead">Enter your order ID to track your package</p>
        </div>
    </div>

    <div class="container">
        <div class="tracking-form mb-5">
            <form method="GET" action="">
                <div class="input-group mb-3">
                    <input type="text" name="order_id" class="form-control form-control-lg" placeholder="Enter Order ID" value="<?php echo isset($_GET['order_id']) ? htmlspecialchars($_GET['order_id']) : ''; ?>">
                    <button class="btn btn-primary" type="submit">Track</button>
                </div>
            </form>
        </div>

        <?php
        if(isset($_GET['order_id'])) {
            $order_id = mysqli_real_escape_string($conShop, $_GET['order_id']);
            
            // First verify if order exists
            $orderCheck = mysqli_query($conShop, "SELECT OrderId FROM orders WHERE OrderId = '$order_id'");
            
            if(mysqli_num_rows($orderCheck) > 0) {
                $tracking = mysqli_query($conShop, "
                    SELECT ot.* 
                    FROM order_tracking ot
                    JOIN orders o ON ot.OrderId = o.OrderId
                    WHERE ot.OrderId = '$order_id' 
                    ORDER BY ot.UpdatedAt DESC
                ");
                
                if(mysqli_num_rows($tracking) > 0) {
                    echo '<div class="tracking-timeline">';
                    while($status = mysqli_fetch_array($tracking)) {
                        ?>
                        <div class="timeline-item">
                            <div class="timeline-date">
                                <?php echo date('d M Y, h:i A', strtotime($status['UpdatedAt'])); ?>
                            </div>
                            <div class="timeline-status">
                                <?php echo $status['Status']; ?>
                            </div>
                            <div class="timeline-location">
                                <?php echo $status['Location']; ?>
                            </div>
                        </div>
                        <?php
                    }
                    echo '</div>';
                } else {
                    ?>
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        Order found but no tracking updates available yet.
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    No order found with this ID. Please check the order ID and try again.
                </div>
                <?php
            }
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
</body>
</html>