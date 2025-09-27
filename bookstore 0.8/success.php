<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Success</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #e8f5e9;
      padding: 50px;
      text-align: center;
    }
    .box {
      max-width: 500px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
    }
    h1 { color: green; }
    p { font-size: 18px; margin-top: 10px; }
    .btn {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 20px;
      background: #0070ba;
      color: white;
      text-decoration: none;
      border-radius: 8px;
    }
    .btn:hover { opacity: 0.9; }
  </style>
</head>
<body>
  <div class="box">
    <h1>✅ Payment Successful</h1>
    <p>Your payment via 
      <strong><?php echo htmlspecialchars($_GET['method'] ?? 'Unknown'); ?></strong> 
      has been completed.
    </p>
    <a href="shop.php" class="btn">Back to Shop</a>
  </div>
</body>
</html>
