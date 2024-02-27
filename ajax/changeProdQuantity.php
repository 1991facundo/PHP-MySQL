<?php
$products = unserialize($_COOKIE['products']);
foreach ($products as $key => $value) {
    if ($_REQUEST['id'] == $value['id']) {
        if ($_REQUEST['type'] == "plus")
            $products[$key]['quantity']++;
        else
            $products[$key]['quantity']--;
    } 
}
setcookie("products", serialize($products));
echo json_encode($products);
?>