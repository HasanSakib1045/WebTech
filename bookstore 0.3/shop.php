<?php
$host="localhost"; 
$user="root"; 
$pass=""; 
$dbname="bookstore";

$conn = new mysqli($host,$user,$pass,$dbname);
if($conn->connect_error){ 
    die("Connection failed: ".$conn->connect_error); 
}

$result = $conn->query("SELECT * FROM books");
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Book Shop</title>
  <style>
    * {
      margin: 0; padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }
    body {
      background: #3a353bff;
      padding: 20px;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }
    h1 {
      text-align: center;
      color: #fff;
    }
    .top-right {
      display: flex;
      align-items: center;
      gap: 10px;
      position: relative;
    }
    .search-box input {
      padding: 8px 12px;
      border: none;
      border-radius: 5px;
      outline: none;
    }
    .cart-btn {
      padding: 8px 15px;
      background: #4b6cb7;
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      cursor: pointer;
    }
    .cart-btn:hover { background: #182848; }
    .cart-count {
      background: #e80206ff;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 12px;
      vertical-align: top;
      margin-left: 5px;
    }
    .cart-dropdown {
      display: none;
      position: absolute;
      top: 40px;
      right: 0;
      background: #fff;
      color: #000;
      width: 250px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      padding: 10px;
      z-index: 100;
    }
    .cart-dropdown h3 { text-align: center; margin-bottom: 10px; }
    .cart-item {
      font-size: 14px;
      margin-bottom: 5px;
      border-bottom: 1px solid #ccc;
      padding: 5px 0;
    }
    .remove-btn {
      background: none;
      border: none;
      color: red;
      cursor: pointer;
      font-size: 14px;
      margin-left: 10px;
    }
    .remove-btn:hover { color: darkred; }
    #cart-total {
      font-weight: bold;
      margin-top: 10px;
      text-align: right;
    }
    .pay-btn {
      width: 100%;
      margin-top: 10px;
      padding: 8px;
      background: green;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }
    .pay-btn:hover { background: darkgreen; }
    .book-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }
    .book-card {
      background: #BAB3B3;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 15px;
      text-align: center;
      transition: 0.3s;
    }
    .book-card:hover { transform: scale(1.05); }
    .book-card img {
      width: 150px;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 15px;
    }
    .book-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #444;
    }
    .book-price {
      font-size: 16px;
      color: #e80206ff;
      margin-bottom: 15px;
    }
    .buy-btn {
      display: inline-block;
      padding: 10px 15px;
      background: #4b6cb7;
      color: #fff;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.3s;
      cursor: pointer;
    }
    .buy-btn:hover { background: #182848; }
  </style>


</head>
<body>
  <header>
    <h1>📚 Our Book Collection</h1>
    <div class="top-right">
      <div class="search-box">
        <input type="text" id="search" placeholder="Search books...">
      </div>
      <div class="cart-btn" onclick="toggleCart()">
        🛒 Cart <span class="cart-count" id="cart-count">0</span>
        <div class="cart-dropdown" id="cart-dropdown">
          <h3>Your Cart</h3>
          <div id="cart-items"></div>
          <hr>
          <div id="cart-total">Total: $0.00</div>
          <button class="pay-btn">💳 Proceed to Payment</button>
        </div>
      </div>
    </div>
  </header>


  <div class="book-container">
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="book-card">
        <img src="<?= $row['image'] ?>" alt="<?= $row['book_name'] ?>">
        <div class="book-title"><?= $row['book_name'] ?></div>
        <div class="book-price">$<?= $row['price'] ?></div>
        <button class="buy-btn" onclick="addToCart('<?= addslashes($row['book_name']) ?>', <?= $row['price'] ?>)">Add to Cart</button>
      </div>
    <?php endwhile; ?>
  </div>

  
  <script>
    let cart = [];
    let cartCount = 0;

    function addToCart(name, price) {
      cart.push({name, price});
      cartCount++;
      document.getElementById("cart-count").innerText = cartCount;
      displayCart();
    }

    function removeFromCart(index) {
      cart.splice(index, 1);
      cartCount--;
      document.getElementById("cart-count").innerText = cartCount;
      displayCart();
    }

    function displayCart() {
      let cartItems = document.getElementById("cart-items");
      cartItems.innerHTML = "";
      let total = 0;
      cart.forEach((item, index) => {
        total += item.price;
        cartItems.innerHTML += `
          <div class="cart-item">
            ${item.name} - $${item.price.toFixed(2)}
            <button class="remove-btn" onclick="removeFromCart(${index})">❌</button>
          </div>
        `;
      });
      document.getElementById("cart-total").innerText = "Total: $" + total.toFixed(2);
    }

    function toggleCart() {
      let dropdown = document.getElementById("cart-dropdown");
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    document.querySelector(".pay-btn").addEventListener("click", () => {
      localStorage.setItem("cartItems", JSON.stringify(cart));
      window.location.href = "payment.php";
    });



   
    document.getElementById("search").addEventListener("keyup", function(){
      let keyword = this.value.toLowerCase();
      document.querySelectorAll(".book-card").forEach(card => {
        let title = card.querySelector(".book-title").innerText.toLowerCase();
        card.style.display = title.includes(keyword) ? "block" : "none";
      });
    });
  </script>
</body>
</html>
