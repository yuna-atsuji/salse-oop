<?php
include "../classes/Product.php";

//create an object
$product_obj = new Product;
$delete_product = $product_obj->deleteProduct($_POST['id']);

?>