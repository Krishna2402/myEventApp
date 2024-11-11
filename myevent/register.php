<?php
// Include database connection
include('includes/db.php');

// Registration logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Hash password for security
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users (name, email, password, phone, address) 
            VALUES (:name, :email, :password, :phone, :address)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $password_hashed,
        ':phone' => $phone,
        ':address' => $address
    ]);

    // Redirect to login page after successful registration
    header('Location: login.php?message=Registration Successful');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyEvent - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form action="register.php" method="POST" id="registerForm">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
            <span id="emailError" class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
            <span id="passwordError" class="text-danger"></span>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" name="address" id="address" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
</div>

<script>
    document.getElementById("registerForm").onsubmit = function(event) {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        
        // Email validation pattern
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!email.match(emailPattern)) {
            event.preventDefault();
            document.getElementById("emailError").innerHTML = "Please enter a valid email address.";
        }
        
        // Password length validation
        if (password.length < 6) {
            event.preventDefault();
            document.getElementById("passwordError").innerHTML = "Password must be at least 6 characters long.";
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
