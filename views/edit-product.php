<?php
session_start();

require_once "../classes/Product.php";

$product_obj = new Product;
$product = $product_obj->getProductById($_GET['id']);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- CDN Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- 自分のCSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
    <nav class="navbar navbar-expand" style="background-color: #e3f2fd;">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="dashboard.php" class="navbar-brand">
                <i class="fa-regular fa-house"></i>HOME
            </a>
            <!-- grow-1 真ん中の要素に「余ったスペース全部使っていいよ」-->
            <span class="flex-gorw-1 text-center fs-4">Welcome, <?= $_SESSION['username'] ?></span>

            <form action="../action/logout.php" method="post">
                <button type="submit" class="btn btn-outline-info"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button>
            </form>
        </div>
    </nav>

    <main>
        <div class="container mt-5">
            <form action="../action/edit-product.php" method="post">
                <!-- id　受け取るためのhidden -->
                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                <label for="product" class="form-label">Product</label>
                <input type="text" name="product" id="product" class="form-control mb-2" value="<?= $product['product_name'] ?>" required autofocus>
                <label for="price" class="form-label">Price</label>
                <div class="input-group mb-2">
                    <span class="input-group-text">$</span>
                    <input type="number" name="price" step="0.01" min="0" class="form-control" value="<?= $product['price'] ?>" required>
                </div>
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control mb-4" value="<?= $product['quantity'] ?>" required>
                <div class="d-flex justify-content-end">
                    <a href="../views/dashboard.php" class="btn btn-secondary ms-3">Cancel</a>
                    <button type="submit" class="btn btn-primary ms-3">Edit</button>
                </div>

            </form>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>