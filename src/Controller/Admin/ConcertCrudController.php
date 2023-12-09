<?php

namespace App\Controller\Admin;

use App\Entity\Concert;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ConcertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Concert::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('artiste.nom'),
            DateField::new('dateConcert'),
            NumberField::new('tarif'),
            TextEditorField::new('description')
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('tarif')
            ;
    }
}
