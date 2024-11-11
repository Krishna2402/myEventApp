<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');  // Redirect to login page if not logged in
    exit();
}

$user_name = $_SESSION['user_name'];  // Get user's name from the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyEvent - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="my-4">Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
    <p>Welcome to MyEvent. You are successfully logged in.</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
