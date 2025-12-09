<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
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
    <div class="container w-25 mx-auto mt-5 ">
        <h1 class="text-center">LOGIN</h1>
        <form action="../action/login.php" method="post">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control mb-2" require autofocus>
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control mb-2" require>
            <button type="submit" class="btn btn-dark w-100 d-block mx-auto mt-4">LOGIN</button>
            <p class="text-center mt-3">
                Don't have an account?
                 <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Create one</a>
            </p>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5  " id="registerModalLabel">REGISTER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../action/register.php" method="post">
                        <label for="first-name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control mb-2" require autofocus>
                        <label for="last-name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control mb-2" require >
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control mb-2" require >
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" minlength="8" aria-describedby="password-info" require>
                        <div class="form-text" id="password-info">
                            Password must be at least 8 characters long.
                        </div>

                        <button type="submit" class="btn btn-dark w-100 mt-4">REGISTER</button>
                    </form>
                </div>

            </div>
        </div>
      







 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>