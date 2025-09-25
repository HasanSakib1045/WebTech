<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Page</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9; }
        h1 { text-align: center; margin-bottom: 20px; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ccc; }
        th { background-color: #4CAF50; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .logout { display: block; width: 100px; margin: 20px auto; padding: 10px; text-align: center; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px; }
        .logout:hover { background-color: #d32f2f; }
    </style>
</head>
<body>
    <h1>Seller Dashboard</h1>

     <table>
        <tr>
            <th>Book Name</th>
            <th>Order Time</th>
            <th>Order Date</th>
            <th>Username</th>
            <th>Price</th>
        </tr>
        
    </table>

    <a class="logout" href="seller-login.php">Logout</a>
</body>
</html>
