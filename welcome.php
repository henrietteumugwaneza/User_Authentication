<?php
session_start();

// ✅ Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="style2.css">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form>
        <h2>Welcome Page</h2>
        <p class="message success">
            Hello, <strong><?php echo $_SESSION['user']; ?></strong>! You are now logged in.
        </p>
        <p><a href="logout.php">Logout</a></p>
    </form>
</body>
</html>