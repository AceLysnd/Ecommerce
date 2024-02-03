<?php include 'admin_validation.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
    <style>
        .card-img-top {
            height: 300px;
            object-fit: cover;
        }
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-body {
            flex-grow: 1;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../images/logo.png" alt="" class="logo">
                <span class="welcome-text">Welcome, Admin!</span>
            </a>
        </div>
    </nav>

    <div class="bg-light mt-3"> <!-- or mt-4 for a larger margin -->
    <h3 class="text-center">Menu Admin</h3>
    </div>
    
    <!-- Admin Control Buttons -->
    <div class="container text-center mt-5">
        <div class="row justify-content-center">
            <div class="col-auto">
                <a href="add_product.php" class="btn btn-primary mb-2" role="button">Tambahkan Produk</a>
                <a href="list_product.php" class="btn btn-secondary mb-2" role="button">Daftar Produk</a>
                <a href="../logout.php" class="btn btn-danger mb-2" role="button">Log Out</a>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
