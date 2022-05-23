<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MediaCrudController extends AbstractCrudController
{
    public const IMAGES_BASE_PATH = 'upload/images/';
    public const IMAGES_UPLOAD_DIR = 'public/upload/images';

    public static function getEntityFqcn(): string
    {
        return Media::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            ImageField::new('path', 'Chemin')
                ->setBasePath(self::IMAGES_BASE_PATH)
                ->setUploadDir(self::IMAGES_UPLOAD_DIR),
        ];
    }
}
