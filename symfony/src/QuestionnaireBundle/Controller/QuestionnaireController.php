<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Answer;
use AppBundle\Entity\MultiAnswer;
use AppBundle\Entity\Question;
use AppBundle\Entity\Questionnaire;
use AppBundle\Entity\User;
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

    public function submitQuestionnaire($questionnaireId) {
        if (!empty($questionnaireId)) {

            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Questionnaire');

            /**
             * @var Questionnaire $questionnaire
             */
            $questionnaire = $repository->findOneBy(array(
                'id' => $questionnaireId
            ));

            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:User');

            $user = $repository->findOneBy(array(
                'id' => 1
            ));

            $xml = '';



            return new JsonResponse(array('success' => 1, 'message'=> 'xml generated'));
        }

        return new JsonResponse(array('success' => 0, 'message'=> 'some data is missing'));
    }

    private function createXML(Questionnaire $questionnaire, User $user) {
        $rootNode = new \SimpleXMLElement( "<?xml version='1.0' encoding='UTF-8' standalone='yes'?><Antworten></Antworten>" );

        $itemNode = $rootNode->addChild('item');
        $itemNode->addChild( 'itemCode', 'mk' );

        // Let's load based on questionnaire:
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Question');

        $question = $repository->findOneBy(array(
            'questionnaireId' => $questionnaire->getId()
        ));

        /**
         * @var Question $question
         */
        while($question != null) {
            $this->buildBlock($question, $user, $rootNode);

            $question = $this->getNextQuestion($question, $user);
        }

        echo $rootNode->asXML();
    }

    private function buildBlock(Question $question, User $user, $rootNode) {
        $itemNode = $rootNode->addChild('Antwort');

        $answer = $this->getAnswer($question, $user);

        if (is_array($answer)) {
            foreach ($answer as $answerKey => $singleAnswer) {
                $itemNode->addAttribute('ID', $answerKey);
                $itemNode->addChild('Ergebnis', $singleAnswer);
            }
        } else {
            $itemNode->addAttribute('ID', $question->getTitle());
            $itemNode->addChild('Ergebnis', $answer);
        }

        return $rootNode;
    }

    private function getAnswer(Question $question, User $user) {
        switch ($question->getType()) {
            case Question::GROUP_FIX:
                return $this->parseGroupFixAnswer($question, $user);

                break;
            case Question::REGISTRATION:
                return $this->parseRegistrationAnswer($question, $user);
                break;
            default:
                $repository = $this->getDoctrine()
                    ->getRepository('AppBundle:Answer');

                /**
                 * @var Answer $answer
                 */
                $answer = $repository->findOneBy(array(
                    'question_id' => $question->getId(),
                    'created_by' => $user->getId()
                ));

                return $answer->getAnswer();
        }
    }

    private function getNextQuestion(Question $question, User $user) {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Question');

        $question = $repository->findOneBy(array(
            'id' => $question->getNextQuestionId()
        ));

        return $question;
    }

    private function parseRegistrationAnswer(Question $question, User $user) {

    }

    private function parseGroupFixAnswer(Question $question, User $user) {
        $answers = array();

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:MultiAnswer');

        /**
         * @var MultiAnswer $multiAnswers
         */
        $multiAnswers = $repository->findBy(array(
            'question_id' => $question->getId(),
            'created_by' => $user->getId()
        ));

        /**
         * @var MultiAnswer $multiAnswer
         */
        foreach ($multiAnswers as $multiAnswer) {
            $answers[$multiAnswer->getAnswerKey()] = $multiAnswer->getAnswer();
        }

        return $answers;
    }
}