<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\CategoryRepository;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/plat', name: 'admin_')]
class PlatController extends AbstractController
{
    /**
     * show all plats from template and/plats route
     * @param PlatRepository $platRepository
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    #[Route('/plats', name: 'plats_list')]
    public function showAllPlats(PlatRepository $platRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('plats/plats-List.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'plats' => $platRepository->findAll(),
        ]);
    }

    /**
     * add a new plat.
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/add', name: 'plat_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newFileName = (new \DateTime())->format('Y-m-d-H-i-s') . uniqid();

            $image = $form->get('image')->getData();
            $extension = $image->guessExtension();
            if (!$extension) {
                // extension cannot be guessed
                $extension = 'bin';
            }
            $newFileName .= ".$extension";
            $image->move(__DIR__ . '/../../public/upload/images/plats/', $newFileName);
            $plat->setImage($newFileName);

            $entityManager->persist($plat);
            $entityManager->flush();

            $this->addFlash('success', 'plat.add_successfully');

            return $this->redirectToRoute('admin_plat_add', [
                'plat' => $plat
            ]);
        }

        return $this->render('plats/plats-form.html.twig', [
            'plat' => $plat,
            'plat_form' => $form->createView(),
        ]);
    }

    /**
     * edit a plat.
     * @param Plat $plat
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/editer/{id}',name: 'plat_edit', methods: ['GET', 'POST'])]
    public function edit(Plat $plat,Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'plat.updated_successfully');

            return $this->redirectToRoute('admin_plat_edit', [
                'id' => $plat->getId(),
            ]);
        }
        return $this->render('admin/index.html.twig', [
            'plat' => $plat,
            'plat_edit_form' => $form->createView(),
        ]);
    }

    /**
     * suppression d'un plat.
     * @param Plat $plat
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/supprimer/{id}', name: 'plat_delete', methods: ['GET', 'POST'])]
    public function delete(Plat $plat, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($plat);
        $entityManager->flush();
        return $this->render('plats/plats-List.html.twig', [
            'plats' => $entityManager->getRepository(Plat::class)->findAll()
        ]);
    }
}
