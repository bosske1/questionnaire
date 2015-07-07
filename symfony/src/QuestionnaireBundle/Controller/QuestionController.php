<?php

namespace QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QuestionController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuestionnaireBundle:Question:question.html.twig');
    }
}