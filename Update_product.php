<?php
require_once("dbInfo.php");

if (!isset($_GET["id"])) {
    echo "No product id provided.";
    exit();
}

$id = (int)$_GET["id"];

$mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$sqlStatement = "SELECT * FROM products WHERE id = $id";
$result = $mysqli->query($sqlStatement);

if ($result->num_rows == 0) {
    echo "Product not found.";
    exit();
}

$record = $result->fetch_assoc();

$result->free_result();
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
</head>
<body>
    <h1>Update Product</h1>

    <form method="post" action="update_product_process.php">
        <!-- Hidden field with id -->
        <input type="hidden" name="id" value="<?= $record['id'] ?>">

        <p>
            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($record['name']) ?>" required>
        </p>
        <p>
            <label>Price:</label>
            <input type="number" step="0.01" name="price" value="<?= $record['price'] ?>" required>
        </p>
        <p>
            <label>Quantity:</label>
            <input type="number" name="quantity" value="<?= $record['quantity'] ?>" required>
        </p>

        <p>
            <button type="submit">Update Product</button>
        </p>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
