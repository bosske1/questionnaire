<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Answer;
use AppBundle\Entity\PotentialAnswer;
use AppBundle\Entity\Question;
use AppBundle\Entity\QuestionAttachment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class QuestionsController extends Controller
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

        return new JsonResponse($preparedData);
    }

    /**
     * @param $question
     */
    private function prepareQuestion($question){
        $questionData = array();

        $questionData['id'] 		= $question->getId();
        $questionData['title'] 		= $question->getTitle();
        $questionData['content'] 	= $question->getContent();
        $questionData['type'] 		= $question->getType();
        $questionData['nextQuestionId']	= $question->getNextQuestionId();

        /**
         * @var PotentialAnswer $potentialAnswer
         */
        foreach ($question->getPotentialAnswers() as $potentialAnswer) {
            $questionData['potentialAnswers'][] = array(
                'id' 			=> $potentialAnswer->getId(),
                'answer' 		=> $potentialAnswer->getAnswer(),
                'questionId' 	=> $question->getId()
            );
        }

        /**
         * @var QuestionAttachment $attachment
         */
        foreach ($question->getAttachments() as $attachment) {
            $questionData['attachments'][] = array(
                'id' 			=> $attachment->getId(),
                'title' 		=> $attachment->getTitle(),
                'path' 			=> $attachment->getPath(),
                'description' 	=> $attachment->getDescription(),
                'questionId' 	=> $question->getId()
            );
        }

        return $questionData;
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
            $questionData = $this->prepareQuestion($question);

            $preparedData[] = $questionData;
        }

        return $preparedData;
    }
}