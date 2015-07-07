<?php

namespace QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuestionnaireBundle:Registration:registration.html.twig');
    }
}