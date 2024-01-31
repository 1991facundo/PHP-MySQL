<?php
if (isset($_REQUEST['save'])) {
    include_once "db_ecommerce.php";
    $con = mysqli_connect($host, $user, $dbPassword, $db);

    $email = mysqli_real_escape_string($con, $_REQUEST['email'] ?? '');
    $pass = md5(mysqli_real_escape_string($con, $_REQUEST['password'] ?? ''));
    $nombre = mysqli_real_escape_string($con, $_REQUEST['name'] ?? '');

    $query = "INSERT INTO users 
        (email       ,password       ,name) VALUES
        ('" . $email . "','" . $password . "','" . $name . "');
        ";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo '<meta http-equiv="refresh" content="0; url=panel.php?module=users&message=user created successfully" />  ';
    } else {
?>
        <div class="alert alert-danger" role="alert">
            Error creating user <?php echo mysqli_error($con); ?>
        </div>
<?php
    }
}
?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create User</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="panel.php?module=createUser" method="post">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" id="" class="form-control" placeholder="name@email.com" alt="email">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="password" alt="password">
                                </div>
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="full name" alt="name">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="save">Create</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>