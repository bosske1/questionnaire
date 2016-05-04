<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\User;
use AppBundle\Entity\UserRegistration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuestionnaireBundle:Registration:registration.html.twig');
    }

	public function registerAction(Request $request)
	{
		// Shit got posted
		$username 	= $request->request->get('username');
		$password 	= $request->request->get('password');
		$email 		= $request->request->get('email');
		$firstname 	= $request->request->get('firstname');
		$lastname 	= $request->request->get('lastname');

		if (empty($username) || empty($password) || empty($email)) {
			return $this->render('QuestionnaireBundle:Registration:registration.html.twig',
				array('error_message' => 'Username, password and email can not be empty!'));
		}

		$user = new User();

		$encoder = $this->container->get('security.password_encoder');
		$encoded = $encoder->encodePassword($user, $password);

		$user->setEmail($email)
			->setUsername($username)
			->setPassword($encoded)
			->setFirstname($firstname)
			->setLastname($lastname);

		$em = $this->getDoctrine()->getManager();

		$em->persist($user);
		$em->flush();

		return $this->redirectToRoute('questionnaire_homepage');
	}

	public function submitRegistrationAction(Request $request)
	{
		$answer = $request->get('answer');
		$questionId = $request->get('questionId');

		if (!empty($questionId) && is_array($answer)) {

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

			$userRegistration = new UserRegistration();;
			$userRegistration->setCreatedAt(new \DateTime());
			$userRegistration->setQuestion($question);
			$userRegistration->setUser($user);
			$userRegistration->setAddress($this->getData($answer['address']));
			$userRegistration->setBirthday($this->getBirthday($answer['birthday']));
			$userRegistration->setCostsOnme($answer['costs_onme']);
			$userRegistration->setCountry($this->getData($answer['country']));
			$userRegistration->setEmail($this->getData($answer['email']));
			$userRegistration->setFirstname($this->getData($answer['firstname']));
			$userRegistration->setLastname($this->getData($answer['lastname']));
			$userRegistration->setMiddlename($this->getData($answer['further_name']));
			$userRegistration->setMobile($this->getData($answer['mobile']));
			$userRegistration->setOrderAnalisys($this->getOptionData($answer,'order_analysis'));
			$userRegistration->setPhone($this->getData($answer['phone']));
			$userRegistration->setPostalCode($this->getData($answer['postal_code']));
			$userRegistration->setResultsUse($answer['results_use']);
			$userRegistration->setSalutation($this->getData($answer['salutation']));
			$userRegistration->setTitle($this->getData($answer['title']));
			$userRegistration->setTown($this->getData($answer['town']));

			$em = $this->getDoctrine()->getManager();
			$em->persist($userRegistration);
			$em->flush();


			return new JsonResponse(array('success' => 1, 'message'=> 'registration saved'));
		}

		return new JsonResponse(array('success' => 0, 'message'=> 'some data is missing'));
	}

	private function getOptionData($answer, $key) {
		return isset($answer[$key]) ? $answer[$key] : 'Keine Antwort';
	}

	private function getData($answer) {
		return empty($answer) ? 'Keine Antwort' : $answer;
	}

	private function getBirthday($answer) {
		return empty($answer) ? 'Keine Antwort' : new \DateTime($answer);
	}
}