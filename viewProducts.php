<?php
    require_once("dbinfo.php");
    $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $sqlStatement = "SELECT * FROM products";
    $result = $mysqli->query($sqlStatement);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
</head>
<body>
    <h1>Product List</h1>

    <p><a href="addProduct.php">Add New Product</a></p>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>

        <?php while($record = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $record["id"] ?></td>
                <td><?= $record["name"] ?></td>
                <td><?= $record["price"] ?></td>
                <td><?= $record["quantity"] ?></td>
                <td>
                    <a href="updateProduct.php?id=<?= $record["id"] ?>">Edit</a> |
                    <a href="deleteProduct.php?id=<?= $record["id"] ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>

    </table>

</body>
</html>
<?php
    $result->free_result();
    $mysqli->close();
?>
