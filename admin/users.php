<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
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
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions
                                            <a href="panel.php=?createUser"> <i class="fa fa-plus"></i> </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    include_once "dbEcommerce.php";
                                    $con = mysqli_connect($host, $user, $dbPassword, $db);
                                    $query = "SELECT id, email, name from users; ";
                                    $res = mysqli_query($con, $query);

                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td>
                                                <a href="editUser.php?id=<?php echo $row['id'] ?>" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                                <a href="users.php?idDelete=<?php echo $row['id'] ?>" class="text-danger"> <i class="fas fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
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