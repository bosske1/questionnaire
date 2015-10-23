<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\Questionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionnaireController extends Controller
{
    /**
     * @param Request $request
     */
    public function createAction(Request $request){
        $success = false;
        $questionnaireCategoryId = $request->request->getInt('category');

        if (!empty($questionnaireCategoryId)) {
            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:QuestionnaireCategory');

            $category = $repository->findOneBy(array(
                'id' => $questionnaireCategoryId
            ));

            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:User');

            $user = $repository->findOneBy(array(
                'id' => 1
            ));

            $questionnaire = new Questionnaire();

            $questionnaire->setUser($user);
            $questionnaire->setCreatedAt(new \DateTime());
            $questionnaire->setName($request->get('name'));
            $questionnaire->setDescription($request->get('description'));
            $questionnaire->setCategory($category);

            $em = $this->getDoctrine()->getManager();
            $em->persist($questionnaire);

            $em->flush();

            $success = true;
            $message = 'questionnaire saved';
        }

        if(!$success){
            $message = 'questionnaire not saved';
        }

        return new JsonResponse(array('success' => $success, 'message' => $message));
    }

    /**
     * @param $questionnaireId
     * @return JsonResponse
     */
    public function getQuestionnaireAction($questionnaireId){
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Questionnaire');

        $questionnaire = $repository->findOneBy(array(
            'id' => $questionnaireId
        ));

        $preparedData = $this->prepareQuestionnaire($questionnaire);

        return new JsonResponse($preparedData);
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