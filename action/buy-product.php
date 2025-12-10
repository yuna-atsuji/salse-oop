<?php
session_start();                 // ← 先に書いてOK

include "../classes/Product.php";



$product = new Product;

$id      = $_POST['id'];
$buy_qty = $_POST['buy_quantity'];

// buyProductが「配列」をreturnする形にしておく
$result = $product->buyProduct($id, $buy_qty);

$_SESSION['buy_result'] = $result;

header("location: ../views/dashboard.php?buy=success");
exit;
