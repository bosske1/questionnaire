<?php

namespace QuestionnaireBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\Questionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionnaireCategoriesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAction()
    {
        // Let's load based on questionnaire:
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:QuestionnaireCategory');

        $categories = $repository->findAll();

        $preparedData = $this->prepareQuestionnaireCategories($categories);

        return new JsonResponse($preparedData);
    }

    /**
     * @param $categories
     * @return array
     */
    private function prepareQuestionnaireCategories($categories){
        $preparedData = array();

        /**
         * @var QuestionnaireCategory $category
         */
        foreach ($categories as $category) {
            $questionnaireCategoryData = $this->prepareQuestionnaireCategory($category);

            $preparedData[] = $questionnaireCategoryData;
        }

        return $preparedData;
    }

    /**
     * @param QuestionnaireCategory $category
     * @return array
     */
    private function prepareQuestionnaireCategory($category){
        $categoryData = array();

        $categoryData['id'] 		    = $category->getId();
        $categoryData['name'] 	        = $category->getName();
        $categoryData['description']	= $category->getDescription();

        return $categoryData;
    }
}