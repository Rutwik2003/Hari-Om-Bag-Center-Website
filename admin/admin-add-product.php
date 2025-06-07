<?php
require_once("classes/Database.php"); // Corrected path to Database.php

session_start();

// Create a database connection
$db = new Database();
$con = $db->connect();

$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = mysqli_real_escape_string($conShop, $_POST['productName']);
    $productDescription = mysqli_real_escape_string($conShop, $_POST['productDescription']);
    $productPrice = (int)$_POST['productPrice']; // Ensure integer type
    $productCategory = mysqli_real_escape_string($conShop, $_POST['productCategory']);
    $productImage = mysqli_real_escape_string($conShop, $_POST['productImage']);
    $isAvailable = mysqli_real_escape_string($conShop, $_POST['isAvailable']);
    $rating = (int)$_POST['rating']; // Ensure integer type
    $brand = mysqli_real_escape_string($conShop, $_POST['brand']);
    $size = mysqli_real_escape_string($conShop, $_POST['size']);
    $specification = mysqli_real_escape_string($conShop, $_POST['specification']);

    $insertQuery = "INSERT INTO products (Title, Description, IsAvailable, Price, ImgPath, Rating, Brand, Size, Specification, Categories) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conShop, $insertQuery);
    mysqli_stmt_bind_param($stmt, "sssissssss", $productName, $productDescription, $isAvailable, $productPrice, $productImage, $rating, $brand, $size, $specification, $productCategory);

    if (mysqli_stmt_execute($stmt)) {
        $message = '<div class="alert alert-success">Product added successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger">Error adding product. Please try again.</div>';
    }
}

// Handle product deletion
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']);
    $deleteQuery = "DELETE FROM products WHERE ProductID = ?";
    $stmt = mysqli_prepare($conShop, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $deleteId);

    if (mysqli_stmt_execute($stmt)) {
        $message = '<div class="alert alert-success">Product deleted successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger">Error deleting product. Please try again.</div>';
    }
}

// Fetch all products
$productQuery = "SELECT ProductID, Title, Description, Price, Categories FROM products"; // Ensure ProductID is included
$productResult = mysqli_query($conShop, $productQuery);

// Add this near the top of the file, after database connection
// Replace the categories query section with this
// Remove these lines:
// $categoriesQuery = "SELECT CategoryID, CategoryName FROM categories ORDER BY CategoryName";
// $categoriesResult = mysqli_query($conShop, $categoriesQuery);

// Add this instead:
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Product - Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-section {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            padding: 40px 0;
            color: white;
            margin-bottom: 30px;
        }
        .add-form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: bold;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-outline-secondary {
            border-color: #28a745;
            color: #28a745;
        }
        .btn-outline-secondary:hover {
            background-color: #28a745;
            color: white;
        }
        .drop-zone {
            border: 2px dashed #28a745;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .drop-zone.dragover {
            background-color: #e0ffe0;
        }
        th.sortable:hover {
            cursor: pointer;
            background-color: #f0f0f0;
        }
        .filter-input {
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

    <!-- Include Header -->
    <?php include_once("./templates/navbar.php"); ?>

    <div class="admin-section">
        <div class="container">
            <h2 class="text-center">Add New Product</h2>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="add-form">
                    <?php echo $message; ?>
                    <form method="POST" action="">
                        <!-- Remove the Product ID input section -->
                        
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Product Description</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Product Price</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required>
                        </div>
                        
                        <!-- Replace the category input with dropdown -->
                        <div class="mb-3">
                            <!-- Replace the category dropdown section with this -->
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Product Category</label>
                                <select class="form-control" id="productCategory" name="productCategory" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($categories as $id => $name): ?>
                                        <option value="<?php echo $id; ?>">
                                            <?php echo htmlspecialchars($name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image URL</label>
                            <input type="text" class="form-control" id="productImage" name="productImage" required>
                        </div>

                        <!-- Drag and Drop Zone -->
                        <div class="drop-zone" id="drop-zone">
                            Drag & Drop Image Here or Click to Upload
                        </div>
                        <input type="file" id="fileInput" name="productImageFile" style="display: none;" accept="image/*">

                        <div class="mb-3">
                            <label for="isAvailable" class="form-label">Availability</label>
                            <input type="text" class="form-control" id="isAvailable" name="isAvailable" value="AVAILABLE" required>
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" class="form-control" id="rating" name="rating" step="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>

                        <div class="mb-3">
                            <label for="size" class="form-label">Size</label>
                            <input type="text" class="form-control" id="size" name="size" required>
                        </div>

                        <div class="mb-3">
                            <label for="specification" class="form-label">Specification</label>
                            <textarea class="form-control" id="specification" name="specification" rows="3" required></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Add Product</button>
                            <a href="admin-dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Display Products -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">Product List</h3>
                <table class="table table-bordered table-hover" id="productTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="sortable" onclick="sortTable(0)">Product ID</th>
                            <th class="sortable" onclick="sortTable(1)">Title</th>
                            <th class="sortable" onclick="sortTable(2)">Description</th>
                            <th class="sortable" onclick="sortTable(3)">Price</th>
                            <th class="sortable" onclick="sortTable(4)">Category</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <th><input type="text" class="filter-input" placeholder="Search ID" onkeyup="filterTable(0, this.value)"></th>
                            <th><input type="text" class="filter-input" placeholder="Search Title" onkeyup="filterTable(1, this.value)"></th>
                            <th><input type="text" class="filter-input" placeholder="Search Description" onkeyup="filterTable(2, this.value)"></th>
                            <th><input type="text" class="filter-input" placeholder="Search Price" onkeyup="filterTable(3, this.value)"></th>
                            <th><input type="text" class="filter-input" placeholder="Search Category" onkeyup="filterTable(4, this.value)"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product = mysqli_fetch_assoc($productResult)): ?>
                            <tr>
                                <td><?php echo $product['ProductID']; ?></td>
                                <td><?php echo $product['Title']; ?></td>
                                <td><?php echo $product['Description']; ?></td>
                                <td><?php echo $product['Price']; ?></td>
                                <td><?php echo $product['Categories']; ?></td>
                                <td>
                                    <a href="edit-product.php?id=<?php echo $product['ProductID']; ?>" class="btn btn-primary">Edit</a>
                                    <a href="?delete_id=<?php echo $product['ProductID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-1.11.0.min.js"></script>
    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('fileInput');

        dropZone.addEventListener('click', () => {
            fileInput.click();
        });

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length) {
                fileInput.files = files;
            }
        });

        function sortTable(columnIndex) {
            const table = document.getElementById("productTable");
            const rows = Array.from(table.rows).slice(2); // Skip header and filter row
            const sortedRows = rows.sort((a, b) => {
                const aText = a.cells[columnIndex].innerText;
                const bText = b.cells[columnIndex].innerText;
                return aText.localeCompare(bText, undefined, {numeric: true});
            });
            sortedRows.forEach(row => table.tBodies[0].appendChild(row));
        }

        function filterTable(columnIndex, filterValue) {
            const rows = document.querySelectorAll('#productTable tbody tr');
            rows.forEach(row => {
                const cellText = row.cells[columnIndex].innerText.toLowerCase();
                row.style.display = cellText.includes(filterValue.toLowerCase()) ? '' : 'none';
            });
        }
    </script>

    <!-- Include Footer -->
    <?php include '../footer.php'; ?>
</body>
</html>