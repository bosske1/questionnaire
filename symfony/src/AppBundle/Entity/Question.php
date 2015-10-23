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
 * @ORM\Table(name="question")
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
	 * @ORM\Column(type="text")
	 */
	protected $content;

	/**
	 * @ORM\Column(type="string", length=15)
	 */
	protected $type;

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
	 * @ORM\Column(type="integer")
	 */
	protected $nextQuestionId;

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
	 * @ORM\OneToMany(targetEntity="QuestionAttachment", mappedBy="question")
	 **/
	protected $attachments;

	/**
	 * @ORM\OneToMany(targetEntity="PotentialAnswer", mappedBy="question")
	 **/
	protected $potentialAnswers;

	/**
	 * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
	 **/
	protected $answers;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $tickLength;

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

	public function setCreatedAtValue()
	{
		$this->createdAt = new \DateTime();
	}
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attachments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->potentialAnswers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Question
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Question
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
     * Set content
     *
     * @param string $content
     * @return Question
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Question
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Question
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

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return Question
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
     * Set questionnaireId
     *
     * @param integer $questionnaireId
     * @return Question
     */
    public function setQuestionnaireId($questionnaireId)
    {
        $this->questionnaireId = $questionnaireId;

        return $this;
    }

    /**
     * Get questionnaireId
     *
     * @return integer 
     */
    public function getQuestionnaireId()
    {
        return $this->questionnaireId;
    }

    /**
     * Set questionnaire
     *
     * @param \AppBundle\Entity\Questionnaire $questionnaire
     * @return Question
     */
    public function setQuestionnaire(\AppBundle\Entity\Questionnaire $questionnaire = null)
    {
        $this->questionnaire = $questionnaire;

        return $this;
    }

    /**
     * Get questionnaire
     *
     * @return \AppBundle\Entity\Questionnaire 
     */
    public function getQuestionnaire()
    {
        return $this->questionnaire;
    }

    /**
     * Add attachments
     *
     * @param \AppBundle\Entity\QuestionAttachment $attachments
     * @return Question
     */
    public function addAttachment(\AppBundle\Entity\QuestionAttachment $attachments)
    {
        $this->attachments[] = $attachments;

        return $this;
    }

    /**
     * Remove attachments
     *
     * @param \AppBundle\Entity\QuestionAttachment $attachments
     */
    public function removeAttachment(\AppBundle\Entity\QuestionAttachment $attachments)
    {
        $this->attachments->removeElement($attachments);
    }

    /**
     * Get attachments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Add potentialAnswers
     *
     * @param \AppBundle\Entity\PotentialAnswer $potentialAnswers
     * @return Question
     */
    public function addPotentialAnswer(\AppBundle\Entity\PotentialAnswer $potentialAnswers)
    {
        $this->potentialAnswers[] = $potentialAnswers;

        return $this;
    }

    /**
     * Remove potentialAnswers
     *
     * @param \AppBundle\Entity\PotentialAnswer $potentialAnswers
     */
    public function removePotentialAnswer(\AppBundle\Entity\PotentialAnswer $potentialAnswers)
    {
        $this->potentialAnswers->removeElement($potentialAnswers);
    }

    /**
     * Get potentialAnswers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPotentialAnswers()
    {
        return $this->potentialAnswers;
    }

    /**
     * Add answers
     *
     * @param \AppBundle\Entity\Answer $answers
     * @return Question
     */
    public function addAnswer(\AppBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \AppBundle\Entity\Answer $answers
     */
    public function removeAnswer(\AppBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set nextQuestionId
     *
     * @param integer $nextQuestionId
     * @return Question
     */
    public function setNextQuestionId($nextQuestionId)
    {
        $this->nextQuestionId = $nextQuestionId;

        return $this;
    }

    /**
     * Get nextQuestionId
     *
     * @return integer 
     */
    public function getNextQuestionId()
    {
        return $this->nextQuestionId;
    }

	/**
	 * @return int
	 */
	public function getTickLength()
	{
		return $this->tickLength;
	}

	/**
	 * @param mixed $tickLength
	 */
	public function setTickLength($tickLength)
	{
		$this->tickLength = $tickLength;

		return $this;
	}
}
