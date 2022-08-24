<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\OneToMany(targetEntity="Bug", mappedBy="reporter")
	 * @var Bug[] An ArrayCollection of Bug objects.
	 */
	private $reportedBugs;

	/**
	 * @ORM\OneToMany(targetEntity="Bug", mappedBy="engineer")
	 * @var Bug[] An ArrayCollection of Bug objects.
	 */
	private $assignedBugs;

	public function __construct($userData = [])
	{
		$this->reportedBugs = new ArrayCollection();
		$this->assignedBugs = new ArrayCollection();
		if (isset($userData['id'])) {
			$this->id = $userData['id'];
		}
		if (isset($userData['name'])) {
			$this->name = $userData['name'];
		}
	}

	public function addReportedBug(Bug $bug)
	{
		$this->reportedBugs[] = $bug;
	}

	public function assignedToBug(Bug $bug)
	{
		$this->assignedBugs[] = $bug;
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
