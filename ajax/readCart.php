<?php
$products = unserialize($_COOKIE['products'] ?? '');
echo json_encode($products);
?>