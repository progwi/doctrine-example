<?php
// update_product.php <id> <new-name>
require_once "bootstrap.php";

if (!isset($argv[1]) || !isset($argv[2])) {
	echo "Usage: update_product.php <id> <new-name>\n";
	return;
}

$id = $argv[1];
$newName = $argv[2];

$product = $entityManager->find('Product', $id);

if ($product === null) {
	echo "Product $id does not exist.\n";
	exit(1);
}

$product->setName($newName);

$entityManager->flush();
