<?php
$host="localhost"; $user="root"; $pass=""; $dbname="bookstore";
$conn = new mysqli($host,$user,$pass,$dbname);
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }


if(isset($_POST['add_book'])){
    $name = $_POST['book_name'];
    $price = $_POST['price'];
    $offer = $_POST['offer'];

    
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $upload_dir = "images/";
    move_uploaded_file($tmp_name, $upload_dir.$image);

    $stmt = $conn->prepare("INSERT INTO books (book_name, price, offer, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss",$name,$price,$offer,$image);
    $stmt->execute();
    $stmt->close();
    header("Location: manager.php");
}


if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    $conn->query("DELETE FROM books WHERE id=$id");
    header("Location: manager.php");
}


if(isset($_POST['update_price'])){
    $id = $_POST['id'];
    $price = $_POST['price'];
    $conn->query("UPDATE books SET price=$price WHERE id=$id");
    header("Location: manager.php");
}


if(isset($_POST['update_offer'])){
    $id = $_POST['id'];
    $offer = $_POST['offer'];
    $conn->query("UPDATE books SET offer=$offer WHERE id=$id");
    header("Location: manager.php");
}

$result = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manager Panel</title>
<style>
body { font-family: Arial; padding: 20px; background:#f2f2f2;}
h1 { text-align:center; margin-bottom:20px;}
form { margin-bottom:20px; }
input, select { padding:5px; margin:5px; }
button { padding:5px 10px; margin:2px; cursor:pointer; border:none; border-radius:4px; }
.add-btn { background:#4CAF50; color:#fff; }
.remove-btn { background:#e80206ff; color:#fff; }
.price-btn { background:#2196F3; color:#fff; }
.offer-btn { background:#ff9800; color:#fff; }
table { width:100%; border-collapse: collapse; background:#fff; }
th, td { border:1px solid #ccc; padding:8px; text-align:center; }
th { background:#4b6cb7; color:#fff; }
tr:hover { background:#f1f1f1; }
img { border-radius:4px; }
</style>
</head>
<body>

<h1>Manager Panel</h1>

<h2>Add New Book</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="book_name" placeholder="Book Name" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="number" name="offer" placeholder="Offer %" value="0">
    <input type="file" name="image" required>
    <button type="submit" name="add_book" class="add-btn">Add Book</button>
</form>

<h2>All Books</h2>
<table>
<tr>
<th>ID</th><th>Name</th><th>Price</th><th>Offer</th><th>Image</th><th>Actions</th>
</tr>
<?php while($row = $result->fetch_assoc()){ ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['book_name'] ?></td>
<td>
<form method="POST" style="display:inline;">
<input type="hidden" name="id" value="<?= $row['id'] ?>">
<input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" style="width:60px;">
<button type="submit" name="update_price" class="price-btn">Set Price</button>
</form>
</td>
<td>
<form method="POST" style="display:inline;">
<input type="hidden" name="id" value="<?= $row['id'] ?>">
<input type="number" name="offer" value="<?= $row['offer'] ?>" style="width:40px;">
<button type="submit" name="update_offer" class="offer-btn">Set Offer</button>
</form>
</td>
<td>
<img src="images/<?= $row['image'] ?>" width="50" alt="<?= $row['book_name'] ?>">
</td>
<td>
<a href="manager.php?remove=<?= $row['id'] ?>" class="remove-btn">Remove Book</a>
</td>
</tr>
<?php } ?>
</table>

</body>
</html>

<script>
    if(localStorage.getItem("managerActive") === "false"){
      document.write("<h2 style='color:red;text-align:center;'>❌ Manager page is inactive!</h2>");
      throw new Error("Manager inactive");
    }
  </script>
