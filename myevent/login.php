<?php
// Include database connection
include('includes/db.php');

// Check if user is logged in (redirect if so)
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Login logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        
        // Handle "remember me" checkbox
        if (isset($_POST['remember'])) {
            setcookie('email', $email, time() + (86400 * 30), "/"); // 1 month cookie
            setcookie('password', $password, time() + (86400 * 30), "/");
        }

        // Redirect to homepage
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyEvent - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
    <form action="login.php" method="POST" id="loginForm">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
            <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p class="mt-3">New user? <a href="register.php">Register here</a></p>
</div>

<script>
    document.getElementById("loginForm").onsubmit = function(event) {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        
        // Email validation pattern
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!email.match(emailPattern)) {
            event.preventDefault();
            alert("Please enter a valid email address.");
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
