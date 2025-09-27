<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .admin-container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      text-align: center;
      width: 400px;
    }
    h1 {
      margin-bottom: 20px;
      font-size: 24px;
      color: #333;
    }
    .btn {
      display: block;
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      background: #007bff;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }
    .btn:hover { background: #0056b3; }
    .status-box { margin-top: 20px; text-align: left; }
    .toggle {
      display: flex; justify-content: space-between;
      margin: 10px 0; padding: 10px;
      background: #f9f9f9; border-radius: 8px; border: 1px solid #ddd;
    }
    .switch { position: relative; display: inline-block; width: 50px; height: 25px; }
    .switch input {display:none;}
    .slider {
      position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
      background-color: #ccc; transition: .4s; border-radius: 25px;
    }
    .slider:before {
      position: absolute; content: "";
      height: 20px; width: 20px; left: 3px; bottom: 3px;
      background-color: white; transition: .4s; border-radius: 50%;
    }
    input:checked + .slider { background-color: #28a745; }
    input:checked + .slider:before { transform: translateX(24px); }
  </style>
</head>
<body>
  <div class="admin-container">
    <h1>Admin Control Panel</h1>

    <button class="btn" onclick="goTo('manager.php')">Manager Control</button>
    <button class="btn" onclick="goTo('seller.php')">Seller Control</button>

    <div class="status-box">
      <h2>Account Status</h2>
      <div class="toggle">
        <span>Manager</span>
        <label class="switch">
          <input type="checkbox" id="managerStatus" checked>
          <span class="slider"></span>
        </label>
      </div>
      <div class="toggle">
        <span>Seller</span>
        <label class="switch">
          <input type="checkbox" id="sellerStatus" checked>
          <span class="slider"></span>
        </label>
      </div>
    </div>
  </div>

  <script>
  
    document.getElementById("managerStatus").checked = localStorage.getItem("managerActive") !== "false";
    document.getElementById("sellerStatus").checked = localStorage.getItem("sellerActive") !== "false";

   
    document.getElementById("managerStatus").addEventListener("change", function(){
      localStorage.setItem("managerActive", this.checked);
      alert("Manager is now " + (this.checked ? "Active ✅" : "Inactive ❌"));
    });

    document.getElementById("sellerStatus").addEventListener("change", function(){
      localStorage.setItem("sellerActive", this.checked);
      alert("Seller is now " + (this.checked ? "Active ✅" : "Inactive ❌"));
    });

    
    function goTo(page) {
      if(page === "manager.php" && localStorage.getItem("managerActive") === "false") {
        alert("❌ Manager page is inactive!");
        return;
      }
      if(page === "seller.php" && localStorage.getItem("sellerActive") === "false") {
        alert("❌ Seller page is inactive!");
        return;
      }
      window.location.href = page;
    }
  </script>
</body>
</html>
