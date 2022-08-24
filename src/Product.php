<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 */
	private $name;

	public function __construct($product = [])
	{
		if (isset($product['id'])) {
			$this->id = $product['id'];
		}
		if (isset($product['name'])) {
			$this->name = $product['name'];
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}
}
