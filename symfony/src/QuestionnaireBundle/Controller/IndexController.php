<?php

namespace QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuestionnaireBundle:Default:index.html.twig');
    }
}
