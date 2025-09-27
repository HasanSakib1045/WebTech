<?php



$host="localhost"; 
$user="root"; 
$pass=""; 
$dbname="bookstore";

$conn = new mysqli($host,$user,$pass,$dbname);
if($conn->connect_error){ 
    die("Connection failed: ".$conn->connect_error); 
}


if(isset($_GET['delete_id'])){
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM orders WHERE id = $delete_id");
    header("Location: seller.php");
    exit();
}


$selected_date = $_GET['date'] ?? date('Y-m-d');
$date_filter = "WHERE order_date = '$selected_date'";

$result = $conn->query("SELECT * FROM orders $date_filter ORDER BY id DESC");


$total_price = 0;
$orders = [];
while($row = $result->fetch_assoc()){
    $total_price += $row['price'];
    $orders[] = $row;
}


$month = date('Y-m');
$month_result = $conn->query("SELECT SUM(price) as monthly_total FROM orders WHERE order_date LIKE '$month-%'");
$month_total = $month_result->fetch_assoc()['monthly_total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f9; }
        h1 { text-align: center; margin-bottom: 20px; color: #333; }
        .filters { text-align: center; margin-bottom: 20px; }
        table { width: 95%; margin: auto; border-collapse: collapse; box-shadow: 0 4px 15px rgba(0,0,0,0.1); background-color: #fff; border-radius: 10px; overflow: hidden; }
        th, td { padding: 12px 15px; text-align: center; }
        th { background-color: #4CAF50; color: white; font-size: 16px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #e1f5fe; transition: 0.3s; }
        td { font-size: 14px; color: #555; }
        .logout { display: block; width: 120px; margin: 30px auto; padding: 10px; text-align: center; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .logout:hover { background-color: #d32f2f; }
        caption { caption-side: top; text-align: center; font-size: 20px; margin-bottom: 15px; font-weight: bold; color: #333; }
        .delete-btn { padding: 6px 12px; background-color: #e53935; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 13px; }
        .delete-btn:hover { background-color: #b71c1c; }
        tfoot td { font-weight: bold; }
    </style>
    <script>
        function confirmDelete(id){
            if(confirm("Are you sure you want to delete this order?")){
                window.location.href = "seller.php?delete_id=" + id + "&date=<?= $selected_date ?>";
            }
        }
        function filterDate(){
            let date = document.getElementById('dateFilter').value;
            window.location.href = "seller.php?date=" + date;
        }
    </script>
</head>
<body>
    <h1>Seller Dashboard</h1>

    <div class="filters">
        <label for="dateFilter">Select Date: </label>
        <input type="date" id="dateFilter" value="<?= $selected_date ?>" onchange="filterDate()">
        <p>📅 Monthly Total Sales (<?= date('F Y') ?>): $<?= number_format($month_total ?? 0, 2) ?></p>
    </div>

    <table>
        <caption>📦 Order History for <?= $selected_date ?></caption>
        <tr>
            <th>Book Name</th>
            <th>Order Time</th>
            <th>Order Date</th>
            <th>Username</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php if(count($orders) > 0): ?>
            <?php foreach($orders as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['book_name']) ?></td>
                    <td><?= $row['order_time'] ?></td>
                    <td><?= $row['order_date'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td>$<?= number_format($row['price'], 2) ?></td>
                    <td><button class="delete-btn" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</button></td>
                </tr>
            <?php endforeach; ?>
            <tfoot>
                <tr>
                    <td colspan="4">Total</td>
                    <td colspan="2">$<?= number_format($total_price, 2) ?></td>
                </tr>
            </tfoot>
        <?php else: ?>
            <tr>
                <td colspan="6">No orders for this date.</td>
            </tr>
        <?php endif; ?>
    </table>

    <a class="logout" href="seller-login.php">Logout</a>
</body>
</html>

<script>
    if(localStorage.getItem("sellerActive") === "false"){
      document.write("<h2 style='color:red;text-align:center;'>❌ Seller page is inactive!</h2>");
      throw new Error("Seller inactive");
    }
  </script>
