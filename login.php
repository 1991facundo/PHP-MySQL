<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My ecommerce</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>My</b>ecommerce
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login</p>
                <?php
                if (isset($_REQUEST['login'])) {
                    session_start();
                    $email = $_REQUEST['email'] ?? '';
                    $password = $_REQUEST['password'] ?? '';
                    $password = md5($password);
                    include_once "admin/dbEcommerce.php";
                    $con = mysqli_connect($host, $user, $dbPassword, $db);
                    $query = "SELECT id,email,name from clients where email='" . $email . "' and password='" . $password . "';  ";
                    $res = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($res);
                    if ($row) {
                        $_SESSION['idClient'] = $row['id'];
                        $_SESSION['emailClient'] = $row['email'];
                        $_SESSION['nameClient'] = $row['name'];
                        header("location: index.php?message=User created successfully");
                    } else {
                ?>
                        <div class="alert alert-danger" role="alert">
                            Login Error <img src="admin/images/haha.jpg" width="200">
                        </div>
                <?php
                    }
                }
                ?>
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                            <a href="register.php" class="text-success float-right">Register</a>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="admin/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="admin/dist/js/adminlte.min.js"></script>

</body>

</html>