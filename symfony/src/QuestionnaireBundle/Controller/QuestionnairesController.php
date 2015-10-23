<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\Questionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionnairesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAction()
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
            $questionnaireData = $this->prepareQuestionnaire($questionnaire);

            $preparedData[] = $questionnaireData;
        }

        return $preparedData;
    }

    /**
     * @param $questionnaire
     * @return array
     */
    private function prepareQuestionnaire($questionnaire){
        $questionnaireData = array();

        // Let's load based on questionnaire:
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Question');

        $questions = $repository->findBy(array(
            'questionnaireId' => $questionnaire->getId()
        ));

        $questionnaireData['id'] 		    = $questionnaire->getId();
        $questionnaireData['category'] 	    = $questionnaire->getCategory()->getName();
        $questionnaireData['name'] 	        = $questionnaire->getName();
        $questionnaireData['description']	= $questionnaire->getDescription();
        $questionnaireData['categoryId']	= $questionnaire->getCategoryId();

        return $questionnaireData;
    }
}