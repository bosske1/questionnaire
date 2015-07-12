<?php

namespace QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends Controller
{
    public function getAction()
    {
        $toReturn = array(
            'type' => 'checkbox',
            'question' => 'Ajmo mala da pravimo lom?',
            'answers' => array(
                1 => 'sto da neeee',
                2 => 'neeee',
                3 => 'jebiga ne!'
            ),
            'correct' => 1
        );

        return new JsonResponse($toReturn);
    }
}