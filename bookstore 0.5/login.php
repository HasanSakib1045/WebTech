<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];

        // Redirect to shop.php
        header("Location: shop.php");
        exit();
    } else {
        echo "<script>alert('Invalid Username or Password!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(135deg, #ffbd08ff, #4a4e50ff);
    }
    .login-container {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      width: 350px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      text-align: center;
    }
    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      width: 100%;
      padding: 12px;
      background: #4b6cb7;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover { background: #182848; }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="" method="POST">
      <input type="text" name="username" placeholder="Enter Username" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <button type="submit">Login</button>
      <p>Don't have an account? <a href="registration.php">Register here</a></p>
    </form>
  </div>
</body>
</html>
