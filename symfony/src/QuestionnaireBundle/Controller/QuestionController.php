<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\PotentialAnswer;
use AppBundle\Entity\Question;
use AppBundle\Entity\QuestionAttachment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends Controller
{
	/**
	 * @param $questionnaireId
	 * @return JsonResponse
	 */
    public function getAction($questionnaireId)
    {
		// Let's load based on questionnaire:
		$repository = $this->getDoctrine()
			->getRepository('AppBundle:Question');

		$questions = $repository->findBy(array(
			'questionnaireId' => $questionnaireId
		));

		$preparedData = $this->prepareQuestions($questions);

        $toReturn = array(
            'status' => 'success',
            'data' => $preparedData
        );

        return new JsonResponse($toReturn);
    }

	/**
	 * @param $questions
	 * @return array
	 */
	private function prepareQuestions($questions)
	{
		$preparedData = array();

		/**
		 * @var Question $question
		 */
		foreach ($questions as $question) {
			$questionData = array();

			$questionData['id'] 		= $question->getId();
			$questionData['title'] 		= $question->getTitle();
			$questionData['content'] 	= $question->getContent();
			$questionData['type'] 		= $question->getType();

			/**
			 * @var PotentialAnswer $potentialAnswer
			 */
			foreach ($question->getPotentialAnswers() as $potentialAnswer) {
				$questionData['potentialAnswers'][] = array(
					'id' => $potentialAnswer->getId(),
					'answer' => $potentialAnswer->getAnswer()
				);
			}

			/**
			 * @var QuestionAttachment $attachment
			 */
			foreach ($question->getAttachments() as $attachment) {
				$questionData['attachments'][] = array(
					'id' => $attachment->getId(),
					'title' => $attachment->getTitle(),
					'path' =>$attachment->getPath()
				);
			}

			$preparedData[] = $questionData;
		}

		return $preparedData;
	}
}