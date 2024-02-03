<?php
include 'session_validation.php';   
include 'db.php';

// Initialize an array to hold user information
$userInfo = [];

// Check if the user ID is set in the session
if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userInfo = $result->fetch_assoc();
    } else {
        echo "User not found.";
    }
} else {
    echo "No user ID in session.";
}
// Ensure the cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // This should be replaced with actual cart data retrieval
}

// Calculate the grand total
$grandTotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $grandTotal += $item['price'] * $item['amount'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
</style>
<body>

<?php
    include 'header.php';
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Purchase Summary</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>User ID: <?php echo $userInfo['id']; ?></p>
                    <p>Name: <?php echo $userInfo['username']; ?></p>
                    <p>Address: <?php echo $userInfo['address']; ?></p>
                    <p>Phone Number: <?php echo $userInfo['contact_no']; ?></p>
                </div>
                <div class="col-md-6">
                    <p>Date: <?php echo date('Y-m-d'); ?></p>
                    <p>PayPal ID: <?php echo $userInfo['paypal_id']; ?></p>
                    <p>Bank Name: My Bank</p>
                    <p>Method: Prepaid</p>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $product): ?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['amount']; ?></td>
                            <td>$<?php echo number_format($product['price'], 2); ?></td>
                            <td>$<?php echo number_format($product['amount'] * $product['price'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Grand Total</th>
                        <th>$<?php echo number_format($grandTotal, 2); ?></th>
                    </tr>
                </tfoot>
            </table>
            <p class="text-end">ECommerce by IAP</p>
            <button id="saveAsPdf" class="btn btn-primary">Print Page</button>
        </div>
    </div>
</div>
    <script>
        document.getElementById('saveAsPdf').addEventListener('click', function() {
        window.print();
        });
    </script>
</body>
</html>
