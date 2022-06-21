<?php

namespace App\Controller\Api;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @method getDoctrine()
 */
#[Route('/api/category', name: 'api_')]
class CategoryController extends AbstractController
{
    /** function that retrieves all categories
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->json($category);
    }

    /**
     * function to add a category
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function store(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_encode($request->getContent(), true);

        $category = new Category();
        $category->setName($data['name']);
        $entityManager->persist($category);
        $entityManager->flush();

        return $this->json($category);
    }
}