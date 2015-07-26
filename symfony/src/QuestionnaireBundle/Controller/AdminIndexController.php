<?php

namespace QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminIndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuestionnaireBundle:Default:index.html.twig');
    }
}
