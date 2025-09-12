<?php

$host="localhost"; $user="root"; $pass=""; $dbname="bookstore";
$conn = new mysqli($host,$user,$pass,$dbname);
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

$result = $conn->query("SELECT * FROM books");
?>

<div class="book-container">
<?php
while($row = $result->fetch_assoc()){
    echo '<div class="book-card">';
    echo '<img src="'.$row['image'].'" alt="'.$row['book_name'].'">';
    echo '<div class="book-title">'.$row['book_name'].'</div>';
    echo '<div class="book-price">$'.$row['price'].'</div>';
    
    echo '<button class="buy-btn" onclick="buyNow(\''.addslashes($row['book_name']).'\', '.$row['price'].')">Add to Cart</button>';
    echo '</div>';
}
?>
</div>


</div>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Book Shop</title>
  <style>
    * {
      margin: 0;
      padding: 0;
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

    .book-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); 
  gap: 15px;
  padding: 10px 0;
}

.book-card {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  padding: 10px;
  text-align: center;
  transition: 0.3s;
}

.book-card:hover {
  transform: scale(1.05);
}

.book-card img {
  width: 120px;  
  height: 160px; 
  object-fit: cover;
  border-radius: 6px;
  margin-bottom: 8px;
}

.book-title {
  font-size: 14px;
  font-weight: bold;
  margin-bottom: 5px;
  color: #333;
}

.book-price {
  font-size: 13px;
  color: #e80206ff;
  margin-bottom: 8px;
}

.cart-btn {
  display: inline-block;
  padding: 5px 8px;
  background: #e80206ff;
  color: #fff;
  border-radius: 5px;
  font-size: 12px;
  text-decoration: none;
  transition: 0.3s;
}

.cart-btn:hover {
  background: #c30004;
}


    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #00000;
    }
    .top-right {
      display: flex;
      align-items: center;
      gap: 10px;
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
      transition: 0.3s;
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

    .cart-dropdown h3 {
      margin-bottom: 10px;
      text-align: center;
    }

    .cart-item {
      font-size: 14px;
      margin-bottom: 5px;
      border-bottom: 1px solid #ccc;
      padding: 5px 0;
    }

    .cart-count {
      background: #e80206ff;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 12px;
      vertical-align: top;
      margin-left: 5px;
    }

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

    .book-card:hover {
      transform: scale(1.05);
    }

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
    }

    .buy-btn:hover {
      background: #182848;
    }

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

.pay-btn:hover {
  background: darkgreen;
}

  </style>
</head>
<body>

    <header>
    <h1>📚 Our Book Collection</h1>
    <div class="top-right">
      <div class="search-box">
        <input type="text" placeholder="Search books...">
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
    
    <div class="book-card">
      <img src="imagesbook1.jpg" alt="Book 1">
      <div class="book-title">The Dark Knight</div>
      <div class="book-price">$12.99</div>
      <button class="buy-btn" onclick="addToCart('The Dark Knight', 12.99)">Add-cart</button>
    </div>

    
    <div class="book-card">
      <img src="imagesbook2.jpg" alt="Book 2">
      <div class="book-title">Harry Potter</div>
      <div class="book-price">$15.49</div>
      <button class="buy-btn" onclick="addToCart('Harry Potter', 15.49)">Add-cart</button>
    </div>

    
    <div class="book-card">
      <img src="imagesbook3.jpg" alt="Book 3">
      <div class="book-title">Sherlock Holmes</div>
      <div class="book-price">$10.50</div>
      <button class="buy-btn" onclick="addToCart('Sherlock Holmes', 10.50)">Add-cart</button>
    </div>

    
    <div class="book-card">
      <img src="imagesbook4.jpg" alt="Book 4">
      <div class="book-title">Game of Thrones</div>
      <div class="book-price">$18.99</div>
      <button class="buy-btn" onclick="addToCart('Game of Thrones', 18.99)">Add-cart</button>
    </div>

   
    <div class="book-card">
      <img src="imagesbook5.jpg" alt="Book 5">
      <div class="book-title">The Alchemist</div>
      <div class="book-price">$9.99</div>
      <button class="buy-btn" onclick="addToCart('The Alchemist', 9.99)">Add-cart</button>
    </div>

   
    <div class="book-card">
      <img src="imagesbook6.jpg" alt="Book 6">
      <div class="book-title">Atomic Habits</div>
      <div class="book-price">$14.25</div>
      <button class="buy-btn" onclick="addToCart('Atomic Habits', 14.25)">Add-cart</button>
    </div>

     <div class="book-card">
      <img src="imagesbook6.jpg" alt="Book 6">
      <div class="book-title">Atomic Habits</div>
      <div class="book-price">$14.25</div>
     <button class="buy-btn" onclick="addToCart('Atomic Habits', 14.25)">Add-cart</button>
    </div>

     <div class="book-card">
      <img src="imagesbook6.jpg" alt="Book 6">
      <div class="book-title">Atomic Habits</div>
      <div class="book-price">$14.25</div>
     <button class="buy-btn" onclick="addToCart('Atomic Habits', 14.25)">Add-cart</button>
    </div>

    <div class="book-card">
      <img src="imagesbook5.jpg" alt="Book 5">
      <div class="book-title">The Alchemist</div>
      <div class="book-price">$9.99</div>
      <button class="buy-btn" onclick="addToCart('The Alchemist', 9.99)">Add-cart</button>
    </div>


    <div class="book-card">
      <img src="imagesbook5.jpg" alt="Book 5">
      <div class="book-title">The Alchemist</div>
      <div class="book-price">$9.99</div>
      <button class="buy-btn" onclick="addToCart('The Alchemist', 9.99)">Add-cart</button>
    </div>


    <div class="book-card">
      <img src="imagesbook5.jpg" alt="Book 5">
      <div class="book-title">The Alchemist</div>
      <div class="book-price">$9.99</div>
      <button class="buy-btn" onclick="addToCart('The Alchemist', 9.99)">Add-cart</button>
    </div>


    <div class="book-card">
      <img src="imagesbook5.jpg" alt="Book 5">
      <div class="book-title">The Alchemist</div>
      <div class="book-price">$9.99</div>
      <button class="buy-btn" onclick="addToCart('The Alchemist', 9.99)">Add-cart</button>
    </div>



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
      cart.forEach((item, index) => {
        cartItems.innerHTML += `
          <div class="cart-item">
            ${item.name} - $${item.price.toFixed(2)}
            <button class="remove-btn" onclick="removeFromCart(${index})">❌</button>
          </div>
        `;
        let total = cart.reduce((sum, item) => sum + item.price, 0);
document.getElementById("cart-total").innerText = "Total: $" + total.toFixed(2);

      });
    }

    function toggleCart() {
      let dropdown = document.getElementById("cart-dropdown");
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }
    document.querySelector(".pay-btn").addEventListener("click", () => {
  localStorage.setItem("cartItems", JSON.stringify(cart)); 
  window.location.href = "payment.php"; 
});

  </script>
  <script>
  function buyNow(name, price){
    // Create cart array with single item
    let cart = [];
    cart.push({name: name, price: price});

    // Save to localStorage
    localStorage.setItem("cartItems", JSON.stringify(cart));

    // Redirect to payment page
    window.location.href = "payment.php";
}
</script>
</body>
</html>
