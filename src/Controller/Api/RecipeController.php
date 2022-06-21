<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
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

    /** function to add a plat
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function store(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data =json_decode($request->getContent(), true);

        $recipe = new Recipe();
        $recipe->setName($data['name']);
        $recipe->setImage($data['image']);
        $recipe->setCategory($data['category']);
        $recipe->setIsActive($data['active']);

        $entityManager->persist($recipe);
        $entityManager->flush();

        return $this->json($recipe);
    }
}