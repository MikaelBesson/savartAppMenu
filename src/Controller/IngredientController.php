<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/ingredient', name: 'admin_')]
class IngredientController extends AbstractController
{
    /**
     * show all ingredients from template and/ingredients route
     * @param IngredientRepository $ingredientRepository
     * @return Response
     */
    #[Route('/ingredients', name: 'ingredients_list')]
   public function showAllIngredients(IngredientRepository $ingredientRepository): Response
    {
        return $this->render('ingredients/ingredients-List.html.twig', [
            'ingredients' => $ingredientRepository->findAll(),
        ]);
    }

    /**
     * add a new ingredient.
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/add', name: 'ingredient_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newFileName = (new \DateTime())->format('Y-m-d H:i:s') . uniqid();

            $image = $form->get('image')->getData();
            $extension = $image->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $newFileName .= ".$extension";
            $image->move(__DIR__ .'/../../public/upload/images/ingredients/', $newFileName);
            $ingredient->setImage($newFileName);

            $entityManager->persist($ingredient);
            $entityManager->flush();

            $this->addFlash('success', 'ingredient.add_successfully');

            return $this->redirectToRoute('admin_ingredient_add', [
                'ingredient' => $ingredient
            ]);
        }

        return $this->render('ingredients/ingredients-form.html.twig', [
            'ingredient' => $ingredient,
            'ingredient_form' => $form->createView(),
        ]);
    }

    /**
     * edit a ingredient.
     * @param Ingredient $ingredient
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/editer/{id}', name: 'ingredient_edit', methods: ['GET', 'POST'])]
    public function edit(Ingredient $ingredient,Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newFileName = (new \DateTime())->format('Y-m-d H:i:s') . uniqid();

            $image = $form->get('image')->getData();
            $extension = $image->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $newFileName .= ".$extension";
            $image->move(__DIR__ .'/../../public/upload/images/ingredients', $newFileName);
            $ingredient->setImage($newFileName);
            $entityManager->flush();

            $this->addFlash('success', 'ingredient.updated_successfully');

            return $this->redirectToRoute('admin_ingredient_edit', [
                'id' => $ingredient->getId(),
            ]);
        }
        return $this->render('admin/index.html.twig', [
            'ingredient' => $ingredient,
            'ingredient_edit_form' => $form->createView(),
        ]);
    }

    /**
     * suppression d'un ingredient.
     * @param Ingredient $ingredient
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/supprimer/{id}', name: 'ingredient_delete', methods: ['GET', 'POST'])]
    public function delete(Ingredient $ingredient, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($ingredient);
        $entityManager->flush();
        return $this->render('ingredients/ingredients-List.html.twig', [
            'ingredients' => $entityManager->getRepository(Ingredient::class)->findAll()
        ]);
    }
}
