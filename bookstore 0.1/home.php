<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Valkyrie Pages</title>
  <link rel="stylesheet" href="home.css">
  <style>
    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-btn {
      background: #333;
      color: #fff;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background: #fff;
      min-width: 160px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
      border-radius: 5px;
    }

    .dropdown-content a {
      color: #333;
      padding: 10px 15px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    
    .book-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 15px;
      margin: 20px auto;
      padding: 0 20px;
      max-width: 900px;
    }

    .book-card {
      background: #f8f8f8;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      padding: 10px;
      text-align: center;
      transition: 0.3s;
    }

    .book-card:hover {
      transform: scale(1.05);
    }

    .book-card img {
      width: 100px;
      height: 140px;
      object-fit: cover;
      border-radius: 6px;
      margin-bottom: 8px;
    }

    .cart-btn {
  background: #e80206ff;
  color: #fff;
  border: none;
  padding: 8px 21px;
  border-radius: 5px;
  margin-top: 8px;
  cursor: pointer;
  font-size: 13px;
  transition: 0.3s;
}

.cart-btn:hover {
  background: #c30004;
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
    }
  </style>
</head>

<body>
  <header>
    <div id="logo">Valkyrie Pages</div>

    <div class="menu">
      <a href="" class="active">Home</a>
      
      <a href="">About</a>
      <a href="applycareer.php" target="_blank">ApplyCareer</a>
      <a href="">Contact</a>

      <div class="dropdown">
        <a href="#" class="dropdown-btn">Login ▾</a>
        <div class="dropdown-content">
          <a href="login.php" target="_blank">Login</a>
          <a href="seller-login.php" target="_blank">Seller Login</a>
          <a href="manager-login.php" target="_blank">Manager Login</a>
          <a href="superadmin-login.php" target="_blank">Superadmin Login</a>
        </div>
      </div>
    </div>
  </header>

  <div class="parallax">
    <h2 id="heading">Valkyrie Pages</h2>
  </div>

  
  <section>
    <div class="book-container">
      <div class="book-card">
        <img src="imagesbook1.jpg" alt="Book 1">
        <div class="book-title">The Dark Knight</div>
        <div class="book-price">$12.99</div>
          <a href="login.php" class="cart-btn">BUY</a>
      </div>

      <div class="book-card">
        <img src="imagesbook2.jpg" alt="Book 2">
        <div class="book-title">Harry Potter</div>
        <div class="book-price">$15.49</div>
       <a href="login.php" class="cart-btn">BUY</a>
      </div>

      <div class="book-card">
        <img src="imagesbook3.jpg" alt="Book 3">
        <div class="book-title">Sherlock Holmes</div>
        <div class="book-price">$10.50</div>
       <a href="login.php" class="cart-btn">BUY</a>
      </div>

      <div class="book-card">
        <img src="imagesbook4.jpg" alt="Book 4">
        <div class="book-title">Game of Thrones</div>
        <div class="book-price">$18.99</div>
        <a href="login.php" class="cart-btn">BUY</a>
      </div>
    </div>
  </section>

  <section>
    <h2>Hidden Pages Website</h2>
    <p>
      Valkyrie Pages – opening the doors of knowledge through every page.
      From timeless classics to modern literature, rare collections to everyday favorites, we bring stories that inspire,
      educate, and stay with you forever.
    </p><br>

    <p>
      Valkyrie Pages isn’t just a bookstore – it’s a world where stories come alive.
      Discover novels, non-fiction, poetry, and hidden gems waiting to be explored.
    </p><br>

    <h1>Valkyrie Pages – Your Story. Your Books. Your Space.</h1><br>
  </section>
</body>
</html>
