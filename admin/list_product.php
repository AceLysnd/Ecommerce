<?php 
    include '../db.php';
    $sql = "SELECT id, name, description, price, image FROM products ORDER BY id DESC";
    $result = $conn->query($sql);

    session_start(); // Start the session at the beginning of the script
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']); // Clear the message after displaying it
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include 'header.php';?>
<div class="container mt-5">
    <h2>Daftar Produk</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="width: 5%;">#ID</th>
                <th scope="col" style="width: 10%;">Foto</th>
                <th scope="col" style="width: 20%;">Nama</th>
                <th scope="col" style="width: 20%;">Deskripsi</th>
                <th scope="col" style="width: 10%;">Harga</th>
                <th scope="col" style="width: 10%;">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT id, name, description, price, image FROM products ORDER BY id ASC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($row["image"]) . "' style='width: 100px;' alt='Product Image'></td>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                    echo "<td>$" . htmlspecialchars($row["price"]) . "</td>";
                    echo "<td> <a href='edit_product.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-primary btn-sm'>Edit</a> <a href='delete_product.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-danger btn-sm'>Delete</a> </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No products found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php include 'sidebar.php';?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>