<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\User;
use AppBundle\Entity\UserRegistration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
			$userRegistration->setAddress($answer['address']);
			$userRegistration->setBirthday(new \DateTime($answer['birthday']));
			$userRegistration->setCostsOnme($answer['costs_onme']);
			$userRegistration->setCountry($answer['country']);
			$userRegistration->setEmail($answer['email']);
			$userRegistration->setFirstname($answer['firstname']);
			$userRegistration->setLastname($answer['lastname']);
			$userRegistration->setMiddlename($answer['further_name']);
			$userRegistration->setMobile($answer['mobile']);
			$userRegistration->setOrderAnalisys($answer['order_analysis']);
			$userRegistration->setPhone($answer['phone']);
			$userRegistration->setPostalCode($answer['postal_code']);
			$userRegistration->setResultsUse($answer['results_use']);
			$userRegistration->setSalutation($answer['salutation']);
			$userRegistration->setTitle($answer['title']);

			$em = $this->getDoctrine()->getManager();
			$em->persist($userRegistration);
			$em->flush();


			return new JsonResponse(array('success' => 1, 'message'=> 'registration saved'));
		}

		return new JsonResponse(array('success' => 0, 'message'=> 'some data is missing'));
	}
}