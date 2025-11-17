<?php
require_once("dbInfo.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $quantity = trim($_POST["quantity"] ?? "");

    // Validate required fields
    if ($name === "" || $price === "" || $quantity === "") {
        // Simple error message
        echo "All fields are required. <a href='add_product.php'>Go back</a>";
        exit();
    }

    $mysqli = new mysqli($hostname, $dbUser, $dbPassword, $db);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    // Escape values for safety
    $nameEscaped = $mysqli->real_escape_string($name);
    $priceEscaped = (float)$price;
    $quantityEscaped = (int)$quantity;

    $sqlStatement = "
        INSERT INTO products (name, price, quantity)
        VALUES ('$nameEscaped', $priceEscaped, $quantityEscaped)
    ";

    if ($mysqli->query($sqlStatement)) {
        // Redirect to home page after successful insert
        header("Location: index.php");
        exit();
    } else {
        echo "Error inserting product: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "Invalid request method.";
}
