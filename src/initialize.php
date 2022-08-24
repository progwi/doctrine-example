<?php

/**
 * Initialize the database with the required data.
 */

require_once "bootstrap.php";

if (!isset($entityManager)) {
	echo "Entity manager is not set.\n";
	return;
}

initialize($entityManager, 'Product', '/products.json');
initialize($entityManager, 'User', '/users.json');

function initialize($entityManager, $entityName, $initialDataFileName)
{
	$repository = $entityManager->getRepository($entityName);
	$initialDataArray = json_decode(file_get_contents(__DIR__ . $initialDataFileName), true);
	$metadata = $entityManager->getClassMetadata($entityName);
	// Save the current generator value
	$generator = $metadata->generatorType;
	// Change the generator to use the id from the json file.
	$metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

	$i = 0;

	foreach ($initialDataArray as $data) {

		// Create a new user entity if it doesn't exist.
		$dbEntity = $repository->find($data['id']);

		if (!$dbEntity) {
			$newEntity = new $entityName($data);
			$entityManager->persist($newEntity);
			$i++;
		}
	}

	if ($i > 0) {
		$entityManager->flush();
		echo "Created $i initial $entityName.\n";
	}

	// Restore the id generator
	$metadata->setIdGeneratorType($generator);
}
