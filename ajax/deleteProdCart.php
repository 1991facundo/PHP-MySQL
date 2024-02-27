<?php
$products = unserialize($_COOKIE['products']);
foreach ($products as $key => $value) {
    if ($_REQUEST['id'] == $value['id']) {
        unset($products[$key]);
    }
}
$products = array_values($products);
setcookie("products", serialize($products));
echo json_encode($products);
?>