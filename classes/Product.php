<?php
  require_once "Database.php";

  class Product extends Database {
    public function addProduct($request){
        $product_name = $request['product'];
        $price = $request['price'];
        $quantity = $request['quantity'];

        $sql = "INSERT INTO `products`(`product_name`, `price`, `quantity`) VALUES ('$product_name','$price','$quantity')";

        if($this->conn->query($sql)){
            header('location: ../views/dashboard.php');
            exit;
        }else{
            die("Error adding product:" .$this->conn->error);
        }

    }

    public function getAllProduct(){
        $sql = "SELECT * FROM products";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving all product:" .$this->conn->error);
        }
    }

    public function getProductById($id){
        $sql = "SELECT * FROM `products` WHERE id=$id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error retrieving the product".$this->conn->error);
        }
    }

    public function deleteProduct($id){
        $sql = "DELETE FROM products WHERE id = $id";

        if($this->conn->query($sql)){
            header('location: ../views/dashboard.php');
            exit;
        }else{
            die("Error deleting the product: " .$this->conn->error);
        }
    }

    public function editProduct($request){
        $id = $request['id'];
        $product_name = $request['product'];
        $price = $request['price'];
        $quantity = $request['quantity'];

        $sql = "UPDATE `products` SET `product_name`='$product_name',`price`='$price',`quantity`='$quantity' WHERE id=$id";

        if($this->conn->query($sql)){
            header('location: ../views/dashboard.php');
            exit;
        }else{
            die("Error editing product:" .$this->conn->error);
        }


    }



  }
?>