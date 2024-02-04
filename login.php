<?php
session_start();

$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = '$username' OR email = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['userid'] = $user['id'];
            
            if ($user['username'] === 'admin') {
                header("Location: admin/index.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }
        } else {
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "User does not exist.";
    }
}

// Check for a registration success message
if (isset($_SESSION['register_success'])) {
    $register_success = $_SESSION['register_success'];
    unset($_SESSION['register_success']);
} else {
    $register_success = '';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>  
    <!-- Include the header for non-logged-in users -->
    <?php include 'header_nologin.php'; ?>
    <style>
        .custom-card-width {
            max-width: 500px;
            margin: auto;
        }
    </style>
    <div class="container mt-5">
        <div class="card custom-card-width" style="margin-bottom: 30px;">
            <div class="card-body">
                <h2 class="card-title text-center">Login</h2>
                <?php if ($login_error != ''): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $login_error; ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username or Email</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="mt-4 text-center">
                    Don't have account? <a href="register.php" class="text-primary">Register</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
