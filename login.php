<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>

    <form action="" method="post">
        <h2>Login Form</h2>
        <label>Email:</label>
        <input type="text" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="login">Login</button>
        <!-- Message for new users -->
    <p>Don't have an account? <a href="signup.php">Create one here</a></p>

    <?php
    session_start();
    include "connect.php";

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // ✅ Get user from DB by email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // If you stored passwords as plain text (not secure)
            if ($password === $row['password']) {
                // Login success
                $_SESSION['user'] = $row['name'];
                echo "<p style='color:green;'>Welcome, " . $_SESSION['user'] . "!</p>";
                // Optionally redirect to dashboard:
                // header("Location: dashboard.php");
            } else {
                echo "<p style='color:red;'>Incorrect password!</p>";
            }
        } else {
            echo "<p style='color:red;'>Account not found!</p>";
        }

        $stmt->close();
        header("location:welcome.php");
    }
    ?>
</body>
</html>