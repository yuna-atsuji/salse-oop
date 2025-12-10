<?php
session_start();

require_once "../classes/Product.php";

$product_obj = new Product;
$products = $product_obj->getAllProduct();

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

    <div class="container w-75 mx-auto my-5">
        <div class="d-flex justify-content-between">
            <h1>Products</h1>
            <button type="button" data-bs-toggle="modal" data-bs-target="#addProductModal" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i>Add Product</button>
        </div>

        <table class="table table-hover mt-4 text-center">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th> <!-- delete & edit --> </th>
                    <th> <!-- buy --> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($product = $products->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['product_name'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td>
                            <a href="../views/delete-product.php?id=<?= $product['id'] ?>" class="btn btn-outline-danger"><i class="fa-regular fa-trash-can"></i></a>
                            <a href="../views/edit-product.php?id=<?= $product['id'] ?>" class="btn btn-outline-success"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#buyProductModal" class="btn btn-outline-warning buyBtn" data-id="<?= $product['id'] ?>" data-name="<?= $product['product_name'] ?>" data-price="<?= $product['price'] ?>" data-qty="<?= $product['quantity'] ?>"><i class="fa-solid fa-cart-shopping"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel"><i class="fa-solid fa-plus"></i>Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../action/add-product.php" method="post">
                        <label for="product" class="form-label">Product</label>
                        <input type="text" name="product" id="product" class="form-control mb-2" require autofocus>
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">$</span>
                            <input type="number" name="price" step="0.01" min="0" class="form-control" require>
                        </div>
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control mb-4" require>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--buy Product Modal -->
    <div class="modal fade" id="buyProductModal" tabindex="-1" aria-labelledby="buyProductModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../action/buy-product.php" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-warning" id="exampleModalLabel"><i class="fa-solid fa-cash-register"></i> Buy Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col ">
                                <label for="product-name" class="text-secondary">Product Name</label>
                                <h4 id="p-name"></h4>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col ">
                                <label for="price" class="text-secondary">Price</label>
                                <h4>$<span id="p-price"></span></h4>
                            </div>
                            <div class="col">
                                <label for="quantity" class="text-secondary">Stocks Left</label>
                                <h4 id="p-qty"></h4>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="buy-quantity" class="text-secondary" class="form-label">Buy Quantity</label>
                                <input type="hidden" name="id" id="p-id">
                                <input type="number" name="buy_quantity" min="1" id="buy-qty" class="form-control" required>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center gap-3">
                        <button class="btn btn-warning px-4 w-50">Buy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <?php if (isset($_GET['buy']) && $_GET['buy'] == "success"): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                new bootstrap.Modal(document.getElementById('buyResultModal')).show();
            });
        </script>
    <?php endif; ?>

    <div class="modal fade" id="buyResultModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../action/pay-product.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title text-warning"><i class="fa-solid fa-dollar-sign"></i>Payment</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php $r = $_SESSION['buy_result']; ?>
                        <div class="row">
                            <div class="col">
                                <label for="product-name" class="form-label text-secondary">Product Name</label>
                                <h4><?= $r['name'] ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="product-name" class="form-label text-secondary">Total Price</label>
                                <h4>$<?= $r['total'] ?></h4>

                            </div>
                            <div class="col">
                                <label for="product-name" class="form-label text-secondary">Buy Quantity</label>
                                <h4><?= $r['buy_qty'] ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="product-name" class="form-label text-secondary">Payment</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">$</span>
                                    <input type="number" name="payment" step="0.01" min="0" class="form-control" require>
                                </div>
                            </div>
                        </div>
                        <!-- hidden で total も送る -->
                        <input type="hidden" name="total" value="<?= $r['total'] ?>">
                        <input type="hidden" name="product_name" value="<?= $r['name'] ?>">
                    </div>
                    <div class="modal-footer d-flex justify-content-center gap-3">
                        <button class="btn btn-secondary px-4 " data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-warning px-4 w-50">Pay</button>
                    </div>
               </div>
            </form>
        </div>
    </div>
   <?php if (
    isset($_GET['pay']) && $_GET['pay'] === 'success' &&
    isset($_SESSION['pay_result'])
): ?>

    <?php $p = $_SESSION['pay_result']; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new bootstrap.Modal(document.getElementById('paymentResultModal')).show();
        });
    </script>

    <div class="modal fade" id="paymentResultModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-circle-check"></i> Payment Successful
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><b><?= $p['name'] ?></b> 購入完了！</p>
                    <p>Total: $<?= $p['total'] ?></p>
                    <p>Payment: $<?= $p['payment'] ?></p>
                    <p>Change: <b>$<?= $p['change'] ?></b></p>
                </div>
                <div class="modal-footer">
                    <a href="dashboard.php" class="btn btn-primary">OK</a>
                </div>
            </div>
        </div>
    </div>

    <?php unset($_SESSION['pay_result']); ?>
<?php endif; ?>




    <script>
        document.querySelectorAll('.buyBtn').forEach(btn => {
            btn.addEventListener('click', function() {

                const name = this.dataset.name;
                const price = this.dataset.price;
                const qty = this.dataset.qty;
                const id = this.dataset.id;

                document.getElementById('p-name').textContent = name;
                document.getElementById('p-price').textContent = price;
                document.getElementById('p-qty').textContent = qty;
                document.getElementById('p-id').value = id;

                document.getElementById('buy-qty').value = 1; // 初期値
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>