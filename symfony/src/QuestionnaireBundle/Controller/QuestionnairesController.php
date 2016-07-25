<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Answer;
use AppBundle\Entity\MultiAnswer;
use AppBundle\Entity\Question;
use AppBundle\Entity\Questionnaire;
use AppBundle\Entity\User;
use AppBundle\Entity\UserRegistration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
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

    protected function sendEmail($from, $to, $subject, $body, $fileAttachment) {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody(
                $body,
                'text/html'
            )
            ->attach(\Swift_Attachment::fromPath($fileAttachment))

        ;
        $this->get('mailer')->send($message);
    }

    public function submitQuestionnaireAction($id) {
        if (!empty($id)) {

            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Questionnaire');

            /**
             * @var Questionnaire $questionnaire
             */
            $questionnaire = $repository->findOneBy(array(
                'id' => $id
            ));

            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:User');

            $user = $repository->findOneBy(array(
                'id' => 1
            ));

            $xml = $this->createXML($questionnaire, $user);

            $filename = $this->container->getParameter('kernel.cache_dir') . '/quest/filename.xml';

            //Create your own folder in the cache directory
            $fs = new Filesystem();
            try {
                $fs->mkdir(dirname($filename));

                //Write your file
                file_put_contents($filename, $xml);

                /**
                 * @var UserRegistration $registration
                 */
                $registration = $this->getUserRegistration($user);

                $body = "Eine neue XML-Datei wurde aus dem PerScreen-Basic-Fragebogen generiert. <br />
                            Name, Erstellungsdatum: {$registration->getFirstname()} {$registration->getLastname()}, " . date('d.m.Y');

                $subject = "Neue XML-Auswertung wurde generiert";

                $to = 'auswertung@perscreen.de';
                $from = 'auswertung@perscreen.de';

                $this->sendEmail($from, $to, $subject, $body, $filename);

                return new JsonResponse(array('success' => 1, 'message'=> 'xml generated'));
            } catch (IOException $e) {
                return new JsonResponse(array('success' => 0, 'message'=> 'An error occured while creating your directory'));
            }
        }

        return new JsonResponse(array('success' => 0, 'message'=> 'some data is missing'));
    }

    private function createXML(Questionnaire $questionnaire, User $user) {
        $rootNode = new \SimpleXMLElement( "<?xml version='1.0' encoding='UTF-8' standalone='yes'?><Antworten></Antworten>" );

        // Let's load based on questionnaire:
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Question');

        $question = $repository->findOneBy(array(
            'questionnaireId' => $questionnaire->getId()
        ));

        /**
         * @var Question $question
         */
        while($question->getType() != Question::FINISHED) {
            $this->buildBlock($question, $user, $rootNode);

            $question = $this->getNextQuestion($question, $user);
        }

        return $rootNode->asXML();
    }

    private function buildBlock(Question $question, User $user, $rootNode) {
        $answer = $this->getAnswer($question, $user);

        if (empty($answer)) {
            return false;
        }

        if (is_array($answer)) {
            foreach ($answer as $answerKey => $singleAnswer) {
                $itemNode = $rootNode->addChild('Antwort');
                $itemNode->addAttribute('ID', $answerKey);
                $itemNode->addChild('Ergebnis', $singleAnswer);
            }
        } else {
            $itemNode = $rootNode->addChild('Antwort');
            $itemNode->addAttribute('ID', $question->getDescription());
            $itemNode->addChild('Ergebnis', $answer);
        }
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
                return $this->parseRegularAnswer($question, $user);
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

    private function parseRegularAnswer(Question $question, User $user) {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Answer');

        /**
         * @var Answer $answer
         */
        $answer = $repository->findOneBy(array(
            'questionId' => $question->getId(),
            'createdBy' => $user->getId()
        ));

        if (empty($answer)) {
            return null;
        }

        return $answer->getAnswer();
    }

    private function parseRegistrationAnswer(Question $question, User $user) {
        /**
         * @var UserRegistration $registration
         */
        $registration = $this->getUserRegistration($user);

        if (!empty($registration)) {
            return array(
                'PA00101' => $registration->getOrderAnalisys(),
                'PA00200' => rand(0, 25),
                'PA00300' => $registration->getSalutation(),
                'PA00400' => $registration->getTitle(),
                'PA00500' => $registration->getFirstname(),
                'PA00600' => $registration->getMiddlename(),
                'PA00700' => $registration->getLastname(),
                'PA00800' => $registration->getAddress(),
                'PA00900' => $registration->getTown(),
                'PA01000' => $registration->getPostalCode(),
                'PA01100' => $registration->getCountry(),
                'PA01200' => $registration->getPhone(),
                'PA01300' => $registration->getMobile(),
                'PA01400' => $registration->getEmail(),
                'ZB02400' => $registration->getBirthday()->format('d.m.Y'),
                'FR12201' => $registration->getResultsUse(),
                'FR12202' => $registration->getCostsOnme()
            );
        } else {
            return null;
        }
    }

    private function parseGroupFixAnswer(Question $question, User $user) {
        $answers = array();

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:MultiAnswer');

        /**
         * @var MultiAnswer $multiAnswers
         */
        $multiAnswers = $repository->findBy(array(
            'questionId' => $question->getId(),
            'createdBy' => $user->getId()
        ));

        /**
         * @var MultiAnswer $multiAnswer
         */
        foreach ($multiAnswers as $multiAnswer) {
            $answers[$multiAnswer->getAnswerKey()] = $multiAnswer->getAnswer();
        }

        return $answers;
    }

    /**
     * @param User $user
     * @return UserRegistration
     */
    private function getUserRegistration(User $user) {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:UserRegistration');

        /**
         * @var UserRegistration $registration
         */
        $registration = $repository->findOneBy(array(
            'userId' => $user->getId()
        ));

        return $registration;
    }
}