<?php include 'session_validation.php'; ?>

<?php

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Calculate the total price
$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>Cart</title>
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

    <div class="container">
    <h2>Shopping Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $productId => $product): ?>
                    <?php
                    $itemTotal = $product['amount'] * $product['price'];
                    $totalPrice += $itemTotal;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['amount']); ?></td>
                        <td>$<?php echo number_format($product['price'], 2); ?></td>
                        <td>$<?php echo number_format($itemTotal, 2); ?></td>
                        <td>
                            <form action="delete_cart_item.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right">Grand Total:</th>
                    <th>$<?php echo number_format($totalPrice, 2); ?></th>
                </tr>
            </tfoot>
        </table>
        <form action="process_checkout.php" method="POST">
            <div>
                <label>
                <input type="radio" name="payment_method" value="Prepaid" required> Prepaid
                </label>
            </div>
            <div>
                <label>
                <input type="radio" name="payment_method" value="Postpaid" required> Postpaid
                </label>
            </div>
            <button type="submit" class="btn btn-success">Proceed to Checkout</button>
        </form>

        <form action="clear_cart.php" method="post" style="margin-top: 20px;">
            <button type="submit" class="btn btn-danger">Clear Cart</button>
        </form>

    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>


    <?php include 'footer.php' ?>
</body>
</html>
