<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
use App\Entity\UserRecipe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @method getDoctrine()
 */
#[Route('/api/recipe', name: 'api_')]
class RecipeController extends AbstractController
{
    /** function that retrieves all plats
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findAll();

        return $this->json($recipe);
    }
}