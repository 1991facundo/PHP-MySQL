<?php
include_once "dbEcommerce.php";
$con = mysqli_connect($host, $user, $dbPassword, $db);

if (isset($_REQUEST['save'])) {
    
    $email = mysqli_real_escape_string($con, $_REQUEST['email'] ?? '');
    $password = md5(mysqli_real_escape_string($con, $_REQUEST['password'] ?? ''));
    $name = mysqli_real_escape_string($con, $_REQUEST['name'] ?? '');
    $id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');

    $query = "UPDATE users SET
        email='" . $email . "', password= '" . $password . "',name='" . $name . "' where id='" . $id . "';
        ";
    $res = mysqli_query($con, $query);
    if ($res) {

        echo
        '<meta http-equiv="refresh" content="0; url=panel.php?module=users&message=User ' . $name . ' edited successfully" />  ';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Error creating user ' . mysqli_error($con) . '
              </div>';
    }
}
?>

<?php
$id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');
$query = "SELECT id,email,password,name from users where id='" . $id . "'; ";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);

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
                            <form action="panel.php?module=editUser" method="post">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" id="" class="form-control" value="<?php echo $row['email'] ?>" required="required" placeholder="name@email.com" alt="email">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="password" alt="password">
                                </div>
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>" required="required" placeholder="full name" alt="name">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
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