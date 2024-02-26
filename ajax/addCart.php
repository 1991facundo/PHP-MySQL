<?php
$products = unserialize($_COOKIE['products'] ?? '');
if (is_array($products) == false) $products = array();
$alreadyProd = false;
foreach ($products as $key => $value) {
    if ($value['id'] == $_REQUEST['id']) {
        $productos[$key]['quantity'] = $products[$key]['quantity'] + $_REQUEST['quantity'];
        $alreadyProd = true;
    }
}
if ($alreadyProd == false) {
    $new = array(
        "id" => $_REQUEST['id'],
        "name" => $_REQUEST['name'],
        "web_path" => $_REQUEST['web_path'],
        "quantity" => $_REQUEST['quantity']
    );
    array_push($products, $new);
}
setcookie("products", serialize($products));
echo json_encode($products);
