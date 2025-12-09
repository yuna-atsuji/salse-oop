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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CDN Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Delete Product</title>
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

    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">

                <div class="text-center mb-4">
                    <i class="fa-solid fa-triangle-exclamation text-warning display-4"></i>
                    <h2 class="fw-light mb-3 text-danger">Delete Product</h2>

                    <p class="fw-bold mb-0">Are you sure you want to delete "<?= $product['product_name'] ?>"?</p>

                </div>
                <div class="row">
                    <div class="col">
                        <a href="../views/dashboard.php" class="btn btn-secondary w-100 mb-3">Cancel</a>
                    </div>
                    <div class="col">
                        <form action="../action/delete-product.php" method="post">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button type="submit" class="btn btn-outline-secondary w-100">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>