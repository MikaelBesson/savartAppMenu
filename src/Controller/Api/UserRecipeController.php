<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
use App\Entity\User;
use App\Entity\UserRecipe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/user-recipe', name:'api_user_recipe_')]
class UserRecipeController extends AbstractController
{
    /**
     * Function to add a recipe
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route('/handle', name:'handle')]
    public function store(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $entityManager->getRepository(User::class)->find(1);
        $recipe = $entityManager->getRepository(Recipe::class)->find((int)$data['recipe']);

        // Handling moment.
        if(in_array($data['moment'], ['midi', 'soir'])) {
            $moment = $data['moment'];
        }
        else {
            $moment = 'midi';
        }

        // Handling the day f week.
        if(in_array($data['day'], ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'])) {
            $day = $data['day'];
        }
        else {
            $day = 'lundi';
        }


        $selected = (bool)$data['selected'];

        if($selected) {
            $userRecipe = new UserRecipe();
            $userRecipe
                ->setUser($user)
                ->setMoment($moment)
                ->setRecipe($recipe)
                ->setDay($day)
            ;

            $entityManager->persist($userRecipe);
        }
        else {
            $recipe = $entityManager->getRepository(UserRecipe::class)->findOneBy([
                'moment' => $moment,
                'day' => $day,
                'user' => $user,
                'recipe' => $recipe,
            ]);
            $entityManager->remove($recipe);
        }

        $entityManager->flush();

        return $this->json([
            'message' => $selected ? "Recette ajoutée !" : "Recette supprimée",
        ]);
    }

    /**
     * Return all user recipes.
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route('/all', name:'all')]
    public function getUserRecipes(EntityManagerInterface $entityManager): JsonResponse
    {
        // TODO faire le système de connexion.
        $user = $entityManager->getRepository(User::class)->find(1);
        return $this->json(
            $entityManager->getRepository(UserRecipe::class)->findBy([
                'user' => $user,
            ])
        );
    }
}