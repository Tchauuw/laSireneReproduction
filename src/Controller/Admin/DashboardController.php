<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Entity\Concert;
use App\Entity\Email;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(AbstractDashboardController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

public function configureActions() : Actions{
        return Actions::new()
            ->add(Crud::PAGE_INDEX, Action::EDIT)
            ->update(Crud::PAGE_INDEX, Action::EDIT,
                fn (Action $action) => $action->setIcon('fa-solid fa-pen-to-square')->setLabel(false))
            ->add(Crud::PAGE_INDEX, Action::DELETE)
            ->update(Crud::PAGE_INDEX, Action::DELETE,
                fn(Action $action) => $action->setIcon('fa-solid fa-trash-can')->setLabel(false));
}

    /*public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::EDIT,
                fn (Action $action) => $action->setIcon('fa-solid fa-pen-to-square')->setLabel(false))
            ->update(Crud::PAGE_INDEX, Action::DELETE,
                fn (Action $action) => $action->setIcon('fa-solid fa-trash-can')->setLabel(false));

    }*/

            // in PHP 7.4 and newer you can use arrow functions
            // ->update(Crud::PAGE_INDEX, Action::NEW,
            //     fn (Action $action) => $action->setIcon('fa fa-file-alt')->setLabel(false))

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration de la sirène')
            ->setLocales(['fr', 'en']);
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToUrl('Retour au site', 'fa-solid fa-house', '/'),
            MenuItem::linkToCrud('Les concerts', 'fa-solid fa-volume-high', Concert::class),
            MenuItem::linkToCrud('Les concerts passés', 'fa-solid fa-volume-low', Concert::class),
            MenuItem::linkToCrud('Les artistes', 'fa-solid fa-user-gear', Artiste::class),
            MenuItem::linkToCrud('Newsletter', 'fa-solid fa-paper-plane', Email::class),
        ];

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
