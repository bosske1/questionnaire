<?php
/**
 * Created by PhpStorm.
 * User: bosske1
 * Date: 7/19/15
 * Time: 12:38 AM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="questionnaire")
 */
class Questionnaire
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
	protected $name;

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
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="questionnaires")
	 * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
	 */
	protected $user;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $categoryId;

	/**
	 * @ORM\ManyToOne(targetEntity="QuestionnaireCategory", inversedBy="questionnaires")
	 * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
	 */
	protected $category;

	/**
	 * @ORM\OneToMany(targetEntity="Question", mappedBy="questionnaire")
	 **/
	private $questions;

	public function __construct()
	{
		$this->questions = new ArrayCollection();
	}

	/**
	 * @return mixed
	 */
	public function getQuestions()
	{
		return $this->questions;
	}

	/**
	 * @param mixed $questions
	 */
	public function setQuestions($questions)
	{
		$this->questions = $questions;

		return $this;
	}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Questionnaire
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Questionnaire
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Questionnaire
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

	public function setCreatedAtValue()
	{
		$this->createdAt = new \DateTime();
	}

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return Questionnaire
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

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

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Questionnaire
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\QuestionnaireCategory $category
     * @return Questionnaire
     */
    public function setCategory(\AppBundle\Entity\QuestionnaireCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\QuestionnaireCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add questions
     *
     * @param \AppBundle\Entity\Question $questions
     * @return Questionnaire
     */
    public function addQuestion(\AppBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \AppBundle\Entity\Question $questions
     */
    public function removeQuestion(\AppBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }
}
