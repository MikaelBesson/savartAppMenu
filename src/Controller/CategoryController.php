<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/category', name: 'admin_')]
class CategoryController extends AbstractController
{
    /** show all categories from template and/categories route
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    #[Route('/categories', name: 'categories_List')]
    public function showAllCategories(CategoryRepository $categoryRepository): Response
    {
        return $this->render('categories/categories-list.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * add a new category.
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/add', name: 'category_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'category.add_successfully');

            return $this->redirectToRoute('admin_category_add', [
                'category' => $category
            ]);
        }

        return $this->render('categories/categories-form.html.twig', [
            'category' => $category,
            'category_form' => $form->createView(),
        ]);
    }

    /**
     * edit a category
     * @param Category $category
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/editer/{id}', name: 'category_edit', methods: ['GET', 'POST'])]
    public function edit(Category $category, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'category.updated_successfully');

            return $this->redirectToRoute('admin_category_edit', [
                'id' => $category->getId(),
            ]);
        }

        return $this->render('admin/index.html.twig', [
            'category' => $category,
            'category_edit_form' => $form->createView(),
        ]);
    }

    /**
     * Suppression d'une categorie.
     * @param Category $category
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/supprimer/{id}', name: 'category_delete', methods: ['GET', 'POST'])]
    public function delete(Category $category, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($category);
        $entityManager->flush();
        return $this->render('categories/categories-list.html.twig',[
            'categories' => $entityManager->getRepository(Category::class)->findAll()
        ]);
    }
}