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

    
    public function buyProduct($id, $buy_qty){
    // 1. 商品情報取得（価格と在庫）
    $sql = "SELECT product_name, price, quantity FROM products WHERE id = $id";
    $result = $this->conn->query($sql);

    if(!$result || $result->num_rows == 0){
        die("Product not found.");
    }

    $product = $result->fetch_assoc();
    $name       = $product['product_name'];
    $price      = $product['price'];
    $stock      = $product['quantity'];

    // 2. 在庫チェック
    if($buy_qty > $stock){
        die("Not enough stock. Current stock is $stock.");
    }

    // 3. 在庫を減らす
    $new_stock = $stock - $buy_qty;
    $sql_update = "UPDATE products SET quantity = $new_stock WHERE id = $id";

    if(!$this->conn->query($sql_update)){
        die("Error updating quantity: " . $this->conn->error);
    }

    // 4. 合計金額を計算
    $total = $price * $buy_qty;

    // 5. 呼び出し元に結果を返す
    return [
        'name'        => $name,
        'price'       => $price,
        'buy_qty'     => $buy_qty,
        'total'       => $total,
        'stock_after' => $new_stock
    ];
}


  }
?>