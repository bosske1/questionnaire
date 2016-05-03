<?php
/**
 * Created by PhpStorm.
 * User: bosske1
 * Date: 7/19/15
 * Time: 1:11 AM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="question_potential_answer")
 */
class PotentialAnswer {
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="text")
	 */
	protected $answer;

	/**
	 * @ORM\Column(type="text")
	 */
	protected $realAnswer;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $createdAt;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $questionId;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $nextQuestionId;

	/**
	 * @ORM\ManyToOne(targetEntity="Question", inversedBy="potentialAnswers")
	 * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
	 */
	protected $question;

	/**
	 *
	 */
	public function setCreatedAtValue()
	{
		$this->createdAt = new \DateTime();
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
     * Set answer
     *
     * @param string $answer
     * @return PotentialAnswer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PotentialAnswer
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
     * Set questionId
     *
     * @param integer $questionId
     * @return PotentialAnswer
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get questionId
     *
     * @return integer 
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set question
     *
     * @param \AppBundle\Entity\Question $question
     * @return PotentialAnswer
     */
    public function setQuestion(\AppBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \AppBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set nextQuestionId
     *
     * @param integer $nextQuestionId
     * @return PotentialAnswer
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
	 * @return mixed
	 */
	public function getRealAnswer()
	{
		return $this->realAnswer;
	}

	/**
	 * @param string $realAnswer
	 * @return $this
	 */
	public function setRealAnswer($realAnswer)
	{
		$this->realAnswer = $realAnswer;

		return $this;
	}


}
