<?php
require_once("classes/Database.php"); // Corrected path to Database.php

session_start();

// Create a database connection
$db = new Database();
$con = $db->connect();

$message = '';

// Check if product ID is provided
if (isset($_GET['id'])) {
    $productID = (int)$_GET['id'];

    // Fetch product details
    $productQuery = "SELECT * FROM products WHERE ProductId = ?";
    $stmt = mysqli_prepare($conShop, $productQuery);
    mysqli_stmt_bind_param($stmt, "i", $productID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        $message = '<div class="alert alert-danger">Product not found.</div>';
    }
} else {
    $message = '<div class="alert alert-danger">No product ID provided.</div>';
}

// Handle form submission for updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($product)) {
    $productName = mysqli_real_escape_string($conShop, $_POST['productName']);
    $productDescription = mysqli_real_escape_string($conShop, $_POST['productDescription']);
    $productPrice = (int)$_POST['productPrice'];
    $productCategory = mysqli_real_escape_string($conShop, $_POST['productCategory']);
    $productImage = mysqli_real_escape_string($conShop, $_POST['productImage']);
    $isAvailable = mysqli_real_escape_string($conShop, $_POST['isAvailable']);
    $rating = (int)$_POST['rating'];
    $brand = mysqli_real_escape_string($conShop, $_POST['brand']);
    $size = mysqli_real_escape_string($conShop, $_POST['size']);
    $specification = mysqli_real_escape_string($conShop, $_POST['specification']);

    $updateQuery = "UPDATE products SET Title = ?, Description = ?, IsAvailable = ?, Price = ?, ImgPath = ?, Rating = ?, Brand = ?, Size = ?, Specification = ?, Categories = ? WHERE ProductID = ?";
    $stmt = mysqli_prepare($conShop, $updateQuery);
    mysqli_stmt_bind_param($stmt, "sssissssssi", $productName, $productDescription, $isAvailable, $productPrice, $productImage, $rating, $brand, $size, $specification, $productCategory, $productID);

    if (mysqli_stmt_execute($stmt)) {
        $message = '<div class="alert alert-success">Product updated successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger">Error updating product. Please try again.</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product - Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
        .admin-section {
            background: linear-gradient(135deg, #04aa6d 0%, #049963 100%);
            padding: 40px 0;
            color: white;
            margin-bottom: 30px;
        }
        .edit-form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: bold;
        }
        .btn-success {
            background-color: #04aa6d;
            border-color: #04aa6d;
        }
        .btn-outline-secondary {
            border-color: #04aa6d;
            color: #04aa6d;
        }
        .btn-outline-secondary:hover {
            background-color: #04aa6d;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php include '../header.php'; ?>

    <div class="admin-section">
        <div class="container">
            <h2 class="text-center">Edit Product</h2>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="edit-form">
                    <?php echo $message; ?>
                    <?php if (isset($product)): ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" value="<?php echo htmlspecialchars($product['Title']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Product Description</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required><?php echo htmlspecialchars($product['Description']); ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Product Price</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" value="<?php echo htmlspecialchars($product['Price']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Product Category</label>
                            <input type="text" class="form-control" id="productCategory" name="productCategory" value="<?php echo htmlspecialchars($product['Categories']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image URL</label>
                            <input type="text" class="form-control" id="productImage" name="productImage" value="<?php echo htmlspecialchars($product['ImgPath']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="isAvailable" class="form-label">Availability</label>
                            <input type="text" class="form-control" id="isAvailable" name="isAvailable" value="<?php echo htmlspecialchars($product['IsAvailable']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" class="form-control" id="rating" name="rating" step="1" value="<?php echo htmlspecialchars($product['Rating']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="<?php echo htmlspecialchars($product['Brand']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="size" class="form-label">Size</label>
                            <input type="text" class="form-control" id="size" name="size" value="<?php echo htmlspecialchars($product['Size']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="specification" class="form-label">Specification</label>
                            <textarea class="form-control" id="specification" name="specification" rows="3" required><?php echo htmlspecialchars($product['Specification']); ?></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Update Product</button>
                            <a href="index.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-1.11.0.min.js"></script>

    <!-- Include Footer -->
    <?php include '../footer.php'; ?>
</body>
</html>