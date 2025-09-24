<?php
session_start();

$host="localhost"; 
$user="root"; 
$pass=""; 
$dbname="bookstore";
$conn = new mysqli($host,$user,$pass,$dbname);
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

$error = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // এখানে ধরে নিচ্ছি seller_users নামে একটা টেবিল আছে
    // columns: id, username, password
    $sql = "SELECT * FROM seller_users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION['seller'] = $username;
        header("Location: seller.php");
        exit;
    } else {
        $error = "❌ Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Seller Login</title>
<style>
    body { font-family: Arial; background: #ececec; display:flex; justify-content:center; align-items:center; height:100vh; }
    .login-box { background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.2); width:300px; text-align:center; }
    input { width:90%; padding:10px; margin:8px 0; border:1px solid #ccc; border-radius:5px; }
    button { width:100%; padding:10px; background:#4b6cb7; color:white; border:none; border-radius:5px; cursor:pointer; }
    button:hover { background:#182848; }
    .error { color:red; margin-top:10px; }
</style>
</head>
<body>
    <div class="login-box">
        <h2>🔐 Seller Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
        <?php if($error) echo "<p class='error'>$error</p>"; ?>
    </div>
</body>
</html>
