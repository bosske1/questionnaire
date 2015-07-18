<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
{

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=25, unique=true)
	 */
	private $username;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $password;

	/**
	 * @ORM\Column(type="string", length=60, unique=true)
	 */
	private $email;

	/**
	 * @ORM\Column(type="string", length=60)
	 */
	private $firstname;

	/**
	 * @ORM\Column(type="string", length=60)
	 */
	private $lastname;

	/**
	 * @ORM\Column(name="is_active", type="boolean")
	 */
	private $isActive;

	/**
	 * @ORM\OneToMany(targetEntity="Questionnaire", mappedBy="user")
	 **/
	private $questionnaires;

	public function __construct()
	{
		$this->isActive = true;
		$this->questionnaires = new ArrayCollection();
	}

	public function getSalt()
	{
		// you *may* need a real salt depending on your encoder
		// see section on salt below
		return 'bamboochabamboochabang';
	}

	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}

	/**
	 * @param mixed $firstname
	 */
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLastname()
	{
		return $this->lastname;
	}

	/**
	 * @param mixed $lastname
	 */
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIsActive()
	{
		return $this->isActive;
	}

	/**
	 * @param mixed $isActive
	 */
	public function setIsActive($isActive)
	{
		$this->isActive = $isActive;

		return $this;

	}

	public function getRoles()
	{
		return array('ROLE_USER');
	}

	public function eraseCredentials()
	{

	}

	/** @see \Serializable::serialize() */
	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->username,
			$this->password,
			$this->salt
		));
	}

	/** @see \Serializable::unserialize() */
	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->username,
			$this->password,
			$this->salt
			) = unserialize($serialized);
	}

	/**
	 * @return mixed
	 */
	public function getQuestionnaires()
	{
		return $this->questionnaires;
	}

	/**
	 * @param mixed $questionnaires
	 */
	public function setQuestionnaires($questionnaires)
	{
		$this->questionnaires = $questionnaires;

		return $this;
	}

}
