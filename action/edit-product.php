<?php

include "../classes/Product.php";

//create an object
$product = new Product;

//Call the method
$product->editProduct($_POST);

?>