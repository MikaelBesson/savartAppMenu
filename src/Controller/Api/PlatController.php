<?php

namespace App\Controller\Api;

use App\Entity\Plat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * @method getDoctrine()
 */
class PlatController extends AbstractController
{
    /** function that retrieves all plats
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $plat = $this->getDoctrine()
            ->getRepository(Plat::class)
            ->findAll();

        return $this->json($plat);
    }

    /** function to add a plat
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function store(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data =json_decode($request->getContent(), true);

        $plat = new Plat();
        $plat->setName($data['name']);
        $plat->setImages($data['image']);
        $plat->setCategory($data['category']);
        $plat->setIsActive($data['active']);

        $entityManager->persist($plat);
        $entityManager->flush();

        return $this->json($plat);
    }
}