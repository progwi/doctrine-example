<?php
// create_product.php <name>
require_once "bootstrap.php";

if (!isset($argv[1])) {
	echo "Usage: create_product.php <name>\n";
	return;
}

$newProductName = $argv[1];

$product = new Product();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";
