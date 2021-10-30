<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign in</p>

                                    <form class="mx-1 mx-md-4" action="login.php" method="post">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="email" name="username" class="form-control" />
                                                <label class="form-label" for="form3Example3c">Username</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="pass" name="pass" class="form-control" />
                                                <label class="form-label" for="form3Example4c">Password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg" style="color:white" name="login">Login</button>
                                            <a type="submit" class="btn btn-primary btn-lg" style="margin-left:15px" href="register.php">Register</a>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    session_start();
    if (isset($_POST['login'])) {
        $username1 = $_POST['username'];
        $passw = $_POST['pass'];
        include "src/config/config.php";

        $query = "select * from db_user where username='$username1' and password='$passw'";
        $result = mysqli_query($conn, $query);

        $user = array();
        //chạy vòng lặp để lấy dữ liệu theo từng hàng 
        while ($r = $result->fetch_array(MYSQLI_BOTH)) {
            $user[] = $r;
        }
        //duyệt dữ liệu từ mảng gán vào biến $st
        for ($i = 0; $i < count($user); $i++) {
            $us = $user[$i];
            if (mysqli_num_rows($result) > 0) {
                if ($us['role_id'] == 1) {
                    $_SESSION['admin'] = $username1;
                    header("Location: src/view/admin/index-admin.php");
                } else if ($us['role_id'] == 2) {
                    setcookie('name', $username1, time() + 3600);
                    $_SESSION['teacher'] = $username1;
                    header("Location: src/view/teacher/index.php");
                } else if ($us['role_id'] == 3) {
                    setcookie('name', $username1, time() + 3600);
                    $_SESSION['student'] = $username1;
                    header("Location: src/view/student/index.php");
                }
            } else {
                header("Location: login.php");
            }
        }
    }
    // 
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>