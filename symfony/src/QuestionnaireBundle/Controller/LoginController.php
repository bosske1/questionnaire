<?php

namespace QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuestionnaireBundle:Login:login.html.twig');
    }
}
