<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Extract and sanitize input
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $retypePassword = $_POST['retypePassword'];
    $email = $conn->real_escape_string($_POST['email']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $contactNo = $conn->real_escape_string($_POST['contactNo']);
    $paypalId = $conn->real_escape_string($_POST['paypalId']);

    // Check if passwords match
    if ($password !== $retypePassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "INSERT INTO users (username, password, email, dob, gender, address, city, contact_no, paypal_id) VALUES ('$username', '$passwordHash', '$email', '$dob', '$gender', '$address', '$city', '$contactNo', '$paypalId')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['register_success'] = "Registration successful. Please log in.";
        header('Location: login.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>  
    <?php
        include 'header_nologin.php';
    ?>
    <style>
        .custom-card-width {
            max-width: 500px;
            margin: auto;
        }
    </style>
<div class="container mt-5">
    <div class="card custom-card-width" style="margin-bottom: 30px;">
    <div class="card-body">
    <h2 class="card-title text-center">Register</h2>
    <form action="register.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="retypePassword" class="form-label">Retype Password</label>
            <input type="password" class="form-control" id="retypePassword" name="retypePassword" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="">Choose...</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <select class="form-select" id="city" name="city" required>
                <option value="">Choose...</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Bandung">Bandung</option>
                <option value="Medan">Medan</option>
                <option value="Bekasi">Bekasi</option>
                <option value="Semarang">Semarang</option>
                <option value="Tangerang">Tangerang</option>
                <option value="Depok">Depok</option>
                <option value="Palembang">Palembang</option>
                <option value="Makassar">Makassar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="contactNo" class="form-label">Contact No</label>
            <input type="text" class="form-control" id="contactNo" name="contactNo" required>
        </div>
        <div class="mb-3">
            <label for="paypalId" class="form-label">PayPal ID</label>
            <input type="text" class="form-control" id="paypalId" name="paypalId">
        </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
    </form>
    <div class="mt-4 text-center">
    Have an account? <a href="login.php" class="text-primary">Login</a>
</div>
</div>
</div>
</div>
</body>
</html>
