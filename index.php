<?php include 'session_validation.php'; ?>
<?php 
    include 'db.php';
    include 'add_cart.php';
    $sql = "SELECT id, name, description, image, price FROM products";
    // Check if a category is selected
    if (isset($_GET['category']) && $_GET['category'] != 'All') {
    $category = $conn->real_escape_string($_GET['category']);
    // Update SQL query to filter by the selected category
    $sql .= " WHERE category = '$category'";
}
    $result = $conn->query($sql);

    $products = []; // Array to hold product data
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        echo "0 results";
    }    
?>

<!DOCTYPE html> 
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>E-Commerce</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css -->
    <link rel="stylesheet" href="style.css">
</head>
<style>
        .navbar-nav .nav-link {
        color: white !important;
        }
        .card-img-top {
            height: 300px;
            object-fit: cover;
        }
        .card-body {
            flex-grow: 1;
        }
        .card {
            width: 100%; 
            margin-bottom: 1rem;
            padding-bottom: 5px;
        }
        .product-card {
        margin-bottom: 20px;
        }

        /* Style for the 'View' and 'Buy' buttons */
        .card-buttons {
            display: flex;
            justify-content: space-between;
        }

        .container {
            padding: 0;
            margin-top: 2px;
        }
        .container-custom {
            padding-left: 15px;
            padding-right: 15px;
        }
        @media (min-width: 992px) {
            .col-lg-3 {
                flex: 0 0 auto;
                width: 25%;
            }
        }
</style>
<body>

<?php include 'header.php' ?>

<div class="bg-light mt-3">
    <h3 class="text-center">Ecommerce</h3>
    <p class="text-center">Selling fresh fruits and veggies!</p>
</div>

    <div class="container">
        <div class="row">
            <!-- Product grid -->
            <div class="col-lg-9">
                <div class="row">
                    <?php foreach ($products as $product): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card product-card">
                                <img src="<?php 
                                            $str = substr($product['image'], 1);
                                            echo $str; 
                                            ?>" 
                                            class="card-img-top" alt="<?php echo $product['name']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                    <p class="card-text">
                                        <?php 
                                        echo (strlen($product['description']) > 100) 
                                        ? mb_substr($product['description'], 0, 100) . "..."
                                        : $product['description']; 
                                        ?>
                                    </p>

                                    <div class="card-buttons">
                                        <a href="details.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Detail</a>
                                        <form method="POST" action="add_cart.php">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                                            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                                            <button type="submit" name="add_to_cart" class="btn btn-primary">+</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Category Sidebar -->
            <div class="col-lg-3 d-none d-lg-block">
            <!-- Sidebar content -->
            <div class="text-end">
                <h3>Product Category</h3>
                    <div class="list-group">
                    <a href="index.php?category=Fruits" class="list-group-item list-group-item-action">Fruits</a>
                    <a href="index.php?category=Vegetables" class="list-group-item list-group-item-action">Vegetables</a>
                    <a href="index.php?category=All" class="list-group-item list-group-item-action">All</a>
                    </div>
            </div>
            </div>
        </div>
    </div>

    </div>
</div>
</div>

<?php include 'footer.php' ?>

</body>
</html>
