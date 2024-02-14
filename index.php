<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyEcommerce</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="admin/plugins/daterangepicker/daterangepicker.css">
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand navbar-dark">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                    </ul>
                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-3" action="index.php">
                        <div class=" input-group input-group-sm">
                            <input class="form-control form-control-navbar bg-gray" type="search" placeholder="Search" aria-label="Search" name="name" value="<?php echo $_REQUEST['name'] ?? ''; ?>">
                            <input type="hidden" name="module" value="products">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Messages Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span class="badge badge-danger navbar-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="admin/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Brad Diesel
                                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">Call me whenever you can...</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="admin/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                John Pierce
                                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">I got your message bro</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="admin/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Nora Silvester
                                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">The subject goes here</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                            </div>
                        </li>
                        <!-- Notifications Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-item dropdown-header">15 Notifications</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                                    <span class="float-right text-muted text-sm">3 mins</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i> 8 friend requests
                                    <span class="float-right text-muted text-sm">12 hours</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-file mr-2"></i> 3 new reports
                                    <span class="float-right text-muted text-sm">2 days</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="row mt-1">
                    <?php
                    include_once "admin/dbecommerce.php";
                    $con = mysqli_connect($host, $user, $dbPassword, $db);
                    $where = " WHERE 1=1";
                    $name = mysqli_real_escape_string($con, $_REQUEST['name'] ?? '');
                    if (!empty($name)) {
                        $where .= " AND name LIKE '%" . $name . "%'";
                    }
                    $queryAcc = "SELECT COUNT(*) as Acc FROM products  $where ;";
                    $resAcc = mysqli_query($con, $queryAcc);
                    $rowAcc = mysqli_fetch_assoc($resAcc);
                    $totalRegs = $rowAcc['Acc'];

                    $elementsPage = 6;

                    $totalPages = ceil($totalRegs / $elementsPage);

                    $pageSel = $_REQUEST['page'] ?? false;

                    if ($pageSel == false) {
                        $initLimit = 0;
                        $pageSel = 1;
                    } else {
                        $initLimit = ($pageSel - 1) * $elementsPage;
                    }
                    $limit = " limit $initLimit,$elementsPage ";
                    $query = "SELECT 
                        p.id,
                        p.name,
                        p.price,
                        p.quantity,
                        f.web_path
                        FROM
                        products AS p
                        INNER JOIN products_files AS pf ON pf.product_id=p.id
                        INNER JOIN files AS f ON f.id=pf.file_id
                        $where
                        GROUP BY p.id
                        $limit
                        ";
                    $res = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-primary">
                                <img class="card-img-top img-thumbnail" src="<?php echo $row['web_path'] ?>" alt="">
                                <div class="card-body">
                                    <h2 class="card-title"><strong><?php echo $row['name'] ?></strong></h2>
                                    <p class="card-text"><strong>Price:</strong><?php echo $row['price'] ?></p>
                                    <p class="card-text"><strong>Quantity:</strong><?php echo $row['quantity'] ?></p>
                                    <a href="#" class="btn btn-primary">Check</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <?php if ($totalPages > 0) : ?>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php
                            $urlParams = '&name=' . urlencode($name);
                            if ($pageSel > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?module=products&page=<?= ($pageSel - 1) . $urlParams; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif;
                            for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item <?= ($pageSel == $i) ? 'active' : ''; ?>">
                                    <a class="page-link" href="index.php?module=products&page=<?= $i . $urlParams; ?>"><?= $i; ?></a>
                                </li>
                            <?php endfor;
                            if ($pageSel < $totalPages) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?module=products&page=<?= ($pageSel + 1) . $urlParams; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>



            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- daterangepicker -->
    <script src="admin/plugins/moment/moment.min.js"></script>
    <script src="admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="admin/dist/js/demo.js"></script>
</body>

</html>