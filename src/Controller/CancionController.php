<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Repository\CancionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/home')]
class CancionController extends AbstractController
{
    // Muestra todas las canciones en la página de índice.
    #[Route('/', name: 'app_canciones_index', methods: ['GET'])]
    public function index(CancionRepository $cancionRepository): Response
    {
        return $this->render('home/home.html.twig', [
            'Cancion' => $cancionRepository->findAll(),
        ]);
    }

    #[Route('/buscar', name: 'app_canciones_buscar', methods: ['GET'])]
    public function buscar(Request $request, CancionRepository $cancionRepository): Response
    {
        $titulo = $request->query->get('titulo');

        if ($titulo) {
            $canciones = $cancionRepository->buscarPorTitulo($titulo);
        } else {
            $canciones = $cancionRepository->findAll();
        }

        return $this->render('home/buscar_canciones.html.twig', [
            'Cancion' => $canciones,
            'titulo' => $titulo,
        
        ]);
    }
 
}
