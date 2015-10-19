<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Answer;
use AppBundle\Entity\PotentialAnswer;
use AppBundle\Entity\Question;
use AppBundle\Entity\QuestionAttachment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
	/**
	 * @param $questionnaireId
	 * @return JsonResponse
	 */
    public function getQuestionnaireAction($questionnaireId)
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

	public function submitAnswerAction(Request $request)
	{
		$answer = $request->get('answer');
		$questionId = $request->get('questionId');
		$type = $request->get('type');

		if (!empty($questionId) && !empty($answer) && !empty($type)) {

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

    /**
     * @return JsonResponse
     */
    public function getTreeAction()
    {
        $data = array(
            array(
                'id' => 1,
                'name' => 'name1',
                'leaf' => false,
                'items' => array(
                    array(
                        'id' => 12,
                        '_main_node_id' => 1,
                        'name' => 'name12',
                        'leaf' => true
                    ),
                    array(
                        'id' => 13,
                        'name' => 'name13',
                        '_main_node_id' => 1,
                        'items' => array(
                            array(
                                'id' => 121,
                                '_main_node_id' => 1,
                                'name' => 'name121',
                                'leaf' => false,
                                'checked' => true,
                                'disabled' => true,
                                'items' => array(
                                    array(
                                        'id' => 1211,
                                        '_main_node_id' => 1,
                                        'name' => 'name1211',
                                        'leaf' => true
                                    )
                                )
                            )
                        )
                    )
                )
            ),
            array(
                'id' => 2,
                'leaf' => true,
                'name' => 'name2'
            )
        );

        return new JsonResponse($data);
    }
}