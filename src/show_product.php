<?php
// show_product.php <id>
require_once "bootstrap.php";

if (!isset($argv[1])) {
	echo "Usage: show_product.php <id>\n";
	return;
}

$id = $argv[1];
$product = $entityManager->find('Product', $id);

if ($product === null) {
	echo "No product found.\n";
	exit(1);
}

echo sprintf("-%s\n", $product->getName());
