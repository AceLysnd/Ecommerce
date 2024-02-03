<?php include 'session_validation.php'; ?>
<?php 
include '../db.php'; 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $productName = $conn->real_escape_string($_POST['productName']);
    $productCategory = $conn->real_escape_string($_POST['productCategory']);
    $productDescription = $conn->real_escape_string($_POST['productDescription']);
    $productPrice = $conn->real_escape_string($_POST['productPrice']);
    
    // Handle file upload
    $target_dir = "../uploads/"; // Specify where you want to store the files
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // You can add file validation here (e.g., size, type)
    move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file);
    
    // Insert into database
    $sql = "INSERT INTO products (name, category, description, price, image) VALUES ('$productName', '$productCategory', '$productDescription', '$productPrice', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "New record created successfully";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include 'header.php'; ?>

<div class="container mt-5">
    <h2>Tambahkan Produk Baru</h2>
    <?php if(!empty($success_message)) { echo "<div class='alert alert-success'>$success_message</div>"; } ?>
    <?php if(!empty($error_message)) { echo "<div class='alert alert-danger'>$error_message</div>"; } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="productName" name="productName" required>
        </div>
        <div class="mb-3">
            <label for="productCategory" class="form-label">Category</label>
            <select class="form-select" id="productCategory" name="productCategory" required>
            <option value="">Select a category</option>
            <option value="Fruits">Fruits</option>
            <option value="Vegetables">Vegetables</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="productDescription" class="form-label">Description</label>
            <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="productPrice" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="productPrice" name="productPrice" required>
        </div>
        <div class="mb-3">
            <label for="productImage" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
    <?php include 'sidebar.php'; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
