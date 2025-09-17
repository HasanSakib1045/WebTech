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
      <button class="pay-btn paypal">Pay with PayPal</button>
      <button class="pay-btn gpay">Pay with Google Pay</button>
      <button class="pay-btn visa">Pay with Visa</button>
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
