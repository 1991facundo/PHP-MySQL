                <div class="row mt-1">
                    <?php

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
                                    <a href="index.php?module=detailProduct&id=<?php echo $row['id'] ?>" class="btn btn-primary">Details</a>
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