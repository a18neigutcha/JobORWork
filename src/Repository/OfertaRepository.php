<?php

namespace App\Repository;

use App\Entity\Oferta;
use App\Entity\Empresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Oferta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oferta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oferta[]    findAll()
 * @method Oferta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfertaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oferta::class);
    }

    // /**
    //  * @return Oferta[] Returns an array of Oferta objects
    //  */
    
    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('o')
    //         ->andWhere('o.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('o.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
   

    /*
    public function findOneBySomeField($value): ?Oferta
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Oferta[] Returns an array of Oferta objects
     */
    
    public function findByEmpresa($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.empresa = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * @return Oferta[]
     */
    public function findAllWithEmpresa(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT o.id, o.titulo, o.descripcion, o.data_pub, e.nombre AS empresaNombre 
            FROM App\Entity\Oferta o LEFT JOIN App\Entity\Empresa e WITH o.empresa = e.id
            '
        );

        return $query->getResult();
    }

}
