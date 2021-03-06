<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Answer;
use AppBundle\Entity\MultiAnswer;
use AppBundle\Entity\PotentialAnswer;
use AppBundle\Entity\Question;
use AppBundle\Entity\QuestionAttachment;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
	/**
	 * @param $questionId
	 * @return JsonResponse
	 */
	public function getAction($questionId)
	{
		// GU: changed because of the RESTful backbone integration :P
        // Now, on question.fetch() question/get/{id} will be called which will return only one question :)
		$repository = $this->getDoctrine()
			->getRepository('AppBundle:Question');

		$question = $repository->findOneBy(array(
			'id' => $questionId
		));

		$preparedData = $this->prepareQuestion($question);

		return new JsonResponse($preparedData);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function submitAnswerAction(Request $request)
	{
		$answer = $request->get('answer');
		$questionId = $request->get('questionId');
		$type = $request->get('type');

		if (empty($answer)) {
			$answer = 'Keine Antwort';
		}

		if (!empty($questionId)) {

			$repository = $this->getDoctrine()
				->getRepository('AppBundle:Question');

			$question = $repository->findOneBy(array(
				'id' => $questionId
			));

			$repository = $this->getDoctrine()
				->getRepository('AppBundle:User');

			$user = $repository->findOneBy(array(
				'id' => 1
			));

			$questionAnswer = new Answer();
			$questionAnswer->setAnswer($answer);
			$questionAnswer->setCreatedAt(new \DateTime());
			$questionAnswer->setQuestion($question);
			$questionAnswer->setUser($user);

			$em = $this->getDoctrine()->getManager();
			$em->persist($questionAnswer);
			$em->flush();


			return new JsonResponse(array('success' => 1, 'message'=> 'answer saved'));
		}

		return new JsonResponse(array('success' => 0, 'message'=> 'some data is missing'));
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function submitMultiAnswerAction(Request $request)
	{
		$answers = $request->get('answers');
		$questionId = $request->get('questionId');
		$type = $request->get('type');

		if (!empty($questionId) && is_array($answers) && !empty($type)) {
			$em = $this->getDoctrine()->getManager();

			$repository = $this->getDoctrine()
				->getRepository('AppBundle:Question');

			/**
			 * @var Question $question
			 */
			$question = $repository->findOneBy(array(
				'id' => $questionId
			));

			$repository = $this->getDoctrine()
				->getRepository('AppBundle:User');

			/**
			 * @var User $user
			 */
			$user = $repository->findOneBy(array(
				'id' => 1
			));

			foreach($answers as $answerKey => $answer) {
				$questionAnswer = new MultiAnswer();
				$questionAnswer->setAnswer($answer);
				$questionAnswer->setCreatedAt(new \DateTime());
				$questionAnswer->setQuestion($question);
				$questionAnswer->setUser($user);
				$questionAnswer->setAnswerKey($answerKey);

				$em->persist($questionAnswer);
			}

			$em->flush();

			return new JsonResponse(array('success' => 1, 'message'=> 'answer saved'));
		}

		return new JsonResponse(array('success' => 0, 'message'=> 'some data is missing'));
	}

	public function createAction(Request $request)
	{
		$questionnaireId = $request->request->getInt('questionnaireId');

		if (!empty($questionnaireId)) {
			$repository = $this->getDoctrine()
				->getRepository('AppBundle:Questionnaire');

			$questionnaire = $repository->findOneBy(array(
				'id' => $questionnaireId
			));

			// Save user:
			$repository = $this->getDoctrine()
				->getRepository('AppBundle:User');

			$user = $repository->findOneBy(array(
				'id' => 1
			));

			$question = new Question();

			$question->setUser($user);
			$question->setCreatedAt(new \DateTime());
			$question->setContent($request->get('content'));
			$question->setDescription($request->get('description'));
			$question->setQuestionnaire($questionnaire);
			$question->setTitle($request->get('title'));
			$question->setType($request->get('type'));

			$em = $this->getDoctrine()->getManager();
			$em->persist($question);

			// Now let's deal with potential answers and a potential file:

			$em->flush();

			return new JsonResponse(array('success' => 1, 'message'=> 'question saved'));
		}
	}

	/**
	 * @param Question $question
	 * @return array
	 */
    private function prepareQuestion(Question $question)
    {
        $questionData = array();

        $questionData['id'] 		= $question->getId();
        $questionData['title'] 		= $question->getTitle();
        $questionData['content'] 	= $question->getContent();
        $questionData['type'] 		= $question->getType();
        $questionData['nextQuestionId']	= $question->getNextQuestionId();
		$questionData['tickLength']	= $question->getTickLength();

        /**
         * @var PotentialAnswer $potentialAnswer
         */
        foreach ($question->getPotentialAnswers() as $potentialAnswer) {
            $questionData['potentialAnswers'][] = array(
                'id' 			=> $potentialAnswer->getId(),
                'answer' 		=> $potentialAnswer->getAnswer(),
                'questionId' 	=> $question->getId(),
	            'nextQuestionId'=> $potentialAnswer->getNextQuestionId(),
	            'realAnswer'    => $potentialAnswer->getRealAnswer()
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
}