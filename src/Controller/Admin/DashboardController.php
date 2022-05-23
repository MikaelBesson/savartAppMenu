<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Ingredient;
use App\Entity\Media;
use App\Entity\Plat;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin")
     */
   public function index(): Response
   {
       return $this->render('admin/index.html.twig');
   }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Welcome Boss');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::LinkToDashboard('dashboard', 'fa fa-home');

        yield MenuItem::subMenu('Utilisateur', 'fa fa-user')->setSubItems([
            MenuItem::linkToCrud('Ajoutez','fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les utilisateurs','fas fa-eye', User::class),
        ]);

        yield MenuItem::subMenu('Categorie', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoutez','fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les Categories','fas fa-eye', Category::class),
        ]);

        yield MenuItem::subMenu('Plat', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoutez','fas fa-plus', Plat::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les plats','fas fa-eye', Plat::class),
        ]);

        yield MenuItem::subMenu('Ingredient', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoutez','fas fa-plus', Ingredient::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les ingredients','fas fa-eye', Ingredient::class),
        ]);

        yield MenuItem::subMenu('Media', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoutez','fas fa-plus', Media::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les medias','fas fa-eye', Media::class),
        ]);
    }
}
