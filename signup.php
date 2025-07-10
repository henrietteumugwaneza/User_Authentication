<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>
<body>
   <form action="" method="post">
    <h2>sign up</h2>
    <label for="">Username:</label>
    <input type="text" name="name" required><br><br>

    <label for="">Email:</label>
    <input type="text" name="email" required><br><br>

    <label for="">Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="log">signup</button>
   </form> 
   <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "connect.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['log'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ✅ Use correct column names: name, email, password
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "✅ User inserted successfully!";
    } else {
        echo "❌ Execute failed: " . $stmt->error;
    }

    $stmt->close();
header("location:login.php");
}

?>
</body>
</html>