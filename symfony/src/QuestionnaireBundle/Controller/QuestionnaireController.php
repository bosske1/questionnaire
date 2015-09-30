<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\Questionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionnaireController extends Controller
{
	/**
	 * @return JsonResponse
	 */
	public function getQuestionnairesAction()
    {
		// Let's load based on questionnaire:
		$repository = $this->getDoctrine()
			->getRepository('AppBundle:Questionnaire');

		$questionnaires = $repository->findAll();

		$preparedData = $this->prepareQuestionnaires($questionnaires);

        return new JsonResponse($preparedData);
    }

	/**
	 * @param $questions
	 * @return array
	 */
	private function prepareQuestionnaires($questionnaires)
	{
		$preparedData = array();

		/**
		 * @var Questionnaire $questionnaire
		 */
		foreach ($questionnaires as $questionnaire) {
			$questionnaireData = array();

			$questionnaireData['id'] 		    = $questionnaire->getId();
			$questionnaireData['category'] 	    = $questionnaire->getCategory()->getName();
			$questionnaireData['name'] 	    = $questionnaire->getName();
			$questionnaireData['description']	= $questionnaire->getDescription();
			$questionnaireData['categoryId']	= $questionnaire->getCategoryId();

			$preparedData[] = $questionnaireData;
		}

		return $preparedData;
	}
}