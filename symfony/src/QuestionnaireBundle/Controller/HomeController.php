<?php

namespace QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuestionnaireBundle:Default:index_admin.html.twig');
    }
}
