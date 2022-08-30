<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/utilisateur', name: 'admin_')]
class UserController extends AbstractController
{
    /**
     * Show all users from template and /utilisateurs route.
     * @param UserRepository $userRepository
     * @return Response
     */
    #[Route('/utilisateurs', name: 'users_list')]
    public function showAllUsers(UserRepository $userRepository): Response
    {
        return $this->render('users/users-list.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * add a new user.
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/add', name: 'user_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'user.add_successfully');

            return $this->redirectToRoute('admin_user_add', [
                'user' => $user
            ]);
        }

        return $this->render('users/users-form.html.twig', [
            'user' => $user,
            'user_form' => $form->createView(),
        ]);
    }

    /**
     * Edit a user.
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     */
    #[Route('/editer/{id}', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(User $user, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $entityManager->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('admin_user_edit', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('users/users-form.html.twig', [
            'user' => $user,
            'user_form' => $form->createView(),
        ]);
    }

    /**
     * Suppression utilisateur.
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/supprimer/{id}', name: 'user_delete', methods: ['GET', 'POST'])]
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->render('users/users-list.html.twig',[
            'users' => $entityManager->getRepository(User::class)->findAll()
        ]);
    }
}