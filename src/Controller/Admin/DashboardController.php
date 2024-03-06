<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use App\Entity\Cancion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Obtiene el correo electrónico del usuario actual
        $userEmail = $this->getUser()->getEmail();

        // Verifica si el usuario es el administrador
        if ('admin@admin.com' !== $userEmail) {
            // Redirige a una página de acceso denegado o realiza otra acción según tus necesidades
            throw $this->createAccessDeniedException('Access Denied: Only admin@admin.com is allowed to access this page.');
        }

        // Si es el administrador, redirige a la página de administración de usuarios
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UsuarioCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('UrMusic');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home', 'homepage');
        yield MenuItem::linkToCrud('Usuario', 'fas fa-user', Usuario::class);
        yield MenuItem::linkToCrud('Cancion', 'fas fa-user', Cancion::class);
    }
}