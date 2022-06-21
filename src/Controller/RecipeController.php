<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\CategoryRepository;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/recipe', name: 'admin_')]
class RecipeController extends AbstractController
{
    /**
     * show all recipes from template and/recipe route
     * @param RecipeRepository $recipeRepository
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    #[Route('/recipe', name: 'recipe_list')]
    public function showAllRecipes(RecipeRepository $recipeRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('recipe/recipe-List.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'recipes' => $recipeRepository->findAll(),
        ]);
    }

    /**
     * add a new recipe.
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/add', name: 'recipe_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
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
            $image->move(__DIR__ . '/../../public/upload/images/recipes/', $newFileName);
            $recipe->setImage($newFileName);

            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash('success', 'recipe.add_successfully');

            return $this->redirectToRoute('admin_recipe_add', [
                'recipe' => $recipe
            ]);
        }

        return $this->render('recipe/recipe-form.html.twig', [
            'recipe' => $recipe,
            'recipe_form' => $form->createView(),
        ]);
    }

    /**
     * edit a recipe.
     * @param Recipe $recipe
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/editer/{id}',name: 'recipe_edit', methods: ['GET', 'POST'])]
    public function edit(Recipe $recipe, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
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
            $image->move(__DIR__ . '/../../public/upload/images/recipes/', $newFileName);
            $recipe->setImage($newFileName);

            $entityManager->flush();

            $this->addFlash('success', 'recipe.updated_successfully');

            return $this->redirectToRoute('admin_recipe_edit', [
                'id' => $recipe->getId(),
            ]);
        }
        return $this->render('recipe/recipe-form.html.twig', [
            'recipe' => $recipe,
            'recipe_form' => $form->createView(),
        ]);
    }

    /**
     * suppression d'une recette.
     * @param Recipe $recipe
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/supprimer/{id}', name: 'recipe_delete', methods: ['GET', 'POST'])]
    public function delete(Recipe $recipe, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($recipe);
        $entityManager->flush();
        return $this->render('recipe/recipe-List.html.twig', [
            'recipes' => $entityManager->getRepository(Recipe::class)->findAll()
        ]);
    }
}
