<?php

namespace App\Controller\Api;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method getDoctrine()
 */
class CategoryController extends AbstractController
{
    public function index(): JsonResponse
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->json($category);
    }

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