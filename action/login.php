<?php
include "../classes/User.php";

//create an object
$user = new User;

//Call the method
$user->login($_POST);

?>