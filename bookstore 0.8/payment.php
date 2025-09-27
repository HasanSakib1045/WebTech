<?php
session_start();
$host="localhost"; 
$user="root"; 
$pass=""; 
$dbname="bookstore";

$conn = new mysqli($host,$user,$pass,$dbname);
if($conn->connect_error){ 
    die("Connection failed: ".$conn->connect_error); 
}

// Get cart from localStorage via POST (we'll use JS to send it)
if(isset($_POST['cartItems'])){
    $cartItems = json_decode($_POST['cartItems'], true);

    $username = "Guest"; // replace with session username if login system exists
    $order_date = date('Y-m-d');
    $order_time = date('H:i:s');

    foreach($cartItems as $item){
        $stmt = $conn->prepare("INSERT INTO orders (book_name, price, username, order_date, order_time) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdsss", $item['name'], $item['price'], $username, $order_date, $order_time);
        $stmt->execute();
    }

    echo "Order placed successfully!";
} else {
    echo "No items in cart!";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    .book-list {
      margin-bottom: 20px;
    }
    .book-item {
      display: flex;
      justify-content: space-between;
      margin: 5px 0;
      padding: 5px;
      border-bottom: 1px solid #ddd;
    }
    .total {
      font-weight: bold;
      text-align: right;
      margin: 10px 0;
      font-size: 18px;
    }
    .payment-options {
      text-align: center;
    }
    .pay-btn {
      display: inline-block;
      margin: 10px;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      color: white;
    }
    .paypal { background: #0070ba; }
    .gpay { background: #000; }
    .visa { background: #1a1f71; }
    .pay-btn:hover { opacity: 0.9; }
  </style>
</head>
<body>
  <div class="container">
    <h1>💳 Checkout</h1>
    <div class="book-list" id="book-list"></div>
    <div class="total" id="total-amount">Total: $0.00</div>
    <div class="payment-options">
      <button class="pay-btn paypal" onclick="window.location.href='success.php?method=PayPal'">Pay with PayPal</button>
      <button class="pay-btn gpay" onclick="window.location.href='success.php?method=Google+Pay'">Pay with Google Pay</button>
      <button class="pay-btn visa" onclick="window.location.href='success.php?method=Visa'">Pay with Visa</button>
    </div>
  </div>

  <script>
    let cart = JSON.parse(localStorage.getItem("cartItems")) || [];
    let bookList = document.getElementById("book-list");
    let total = 0;

    cart.forEach(item => {
      let div = document.createElement("div");
      div.classList.add("book-item");
      div.innerHTML = `<span>${item.name}</span><span>$${item.price.toFixed(2)}</span>`;
      bookList.appendChild(div);
      total += item.price;
    });

    document.getElementById("total-amount").innerText = "Total: $" + total.toFixed(2);
  </script>
</body>
</html>
