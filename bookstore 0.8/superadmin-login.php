<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SuperAdmin Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #f30b0bff, #d2dae8ff);
    }

    .login-container {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      width: 350px;
      text-align: center;
      animation: fadeIn 0.8s ease-in-out;
    }

    .login-container h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .login-container input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    .login-container button {
      width: 100%;
      padding: 12px;
      background: #4b6cb7;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    .login-container button:hover {
      background: #182848;
    }

    .login-container p {
      margin-top: 15px;
      font-size: 14px;
      color: #555;
    }

    .login-container a {
      color: #4b6cb7;
      text-decoration: none;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: scale(0.9);}
      to {opacity: 1; transform: scale(1);}
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>SuperAdmin Login</h2>
    <form action="admin.php" method="POST">
      <input type="text" name="username" placeholder="Enter Username" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
