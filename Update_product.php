<?php

$id = $_GET["id"];
$sqlStatement = "SELECT * from products where id=$id";
$result = $mysqli -> query($sqlStatement);

$record = $result -> fetch_assoc();

?>
