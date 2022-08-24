<?php
// list_products.php
require_once "bootstrap.php";

if (!isset($entityManager)) {
	echo "Entity manager is not set.\n";
	return;
}

$productRepository = $entityManager->getRepository('Product');
$products = $productRepository->findAll();

foreach ($products as $product) {
	echo sprintf("-%s\n", $product->getName());
}
