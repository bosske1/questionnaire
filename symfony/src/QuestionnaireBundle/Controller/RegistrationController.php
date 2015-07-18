<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\User;
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
}