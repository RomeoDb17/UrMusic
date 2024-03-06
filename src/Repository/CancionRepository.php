<?php
namespace App\Repository;

use App\Entity\Cancion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CancionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cancion::class);
    }

    /**
     * Busca canciones por título.
     * @param string $titulo El título de la canción a buscar.
     * @return Cancion[] Devuelve un array de canciones que coinciden con el título proporcionado.
     */
    public function buscarPorTitulo($titulo)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.titulo LIKE :titulo')
            ->setParameter('titulo', '%' . $titulo . '%')
            ->getQuery()
            ->getResult();
    }
}
