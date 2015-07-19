<?php
/**
 * Created by PhpStorm.
 * User: bosske1
 * Date: 7/19/15
 * Time: 12:38 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="questionnaire")
 */
class Question
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $title;

	/**
	 * @ORM\Column(type="text")
	 */
	protected $description;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $createdAt;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $createdBy;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $questionnaireId;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="questionnaires")
	 * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
	 */
	protected $user;

	/**
	 * @ORM\ManyToOne(targetEntity="Questionnaire", inversedBy="questions")
	 * @ORM\JoinColumn(name="questionnaire_id", referencedColumnName="id")
	 */
	protected $questionnaire;

	/**
	 * Set user
	 *
	 * @param \AppBundle\Entity\User $user
	 * @return Questionnaire
	 */
	public function setUser(\AppBundle\Entity\User $user = null)
	{
		$this->user = $user;

		return $this;
	}

	/**
	 * Get user
	 *
	 * @return \AppBundle\Entity\User
	 */
	public function getUser()
	{
		return $this->user;
	}
}
