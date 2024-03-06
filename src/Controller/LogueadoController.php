<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogueadoController extends AbstractController
{
    #[Route('/logueado', name: 'app_logueado')]
    public function index(): Response
    {
        return $this->render('home/home.html.twig');
    }
}