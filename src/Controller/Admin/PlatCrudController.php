<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plat::class;
    }


    /** returns the "easy admin" view for plat management
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            BooleanField::new('is_active', 'Cacher/Activer'),
            ImageField::new('media'),
            ChoiceField::new('category')->setChoices([
                'Entree' => 'entree',
                'Plat' => 'plat',
                'Accompagnement' => 'accompagnement',
                'Fromage' => 'fromage',
                'Dessert' => 'dessert',
                'Fruit' => 'fruit',
            ]),
        ];
    }
}
