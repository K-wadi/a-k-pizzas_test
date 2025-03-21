<?php
// Dit bestand zorgt voor het ophalen van pizza's uit de database

namespace App\Repository;

// We importeren alle benodigde onderdelen
use App\Entity\Pizza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Deze class zorgt voor het ophalen van pizza's uit de database
 * @extends ServiceEntityRepository<Pizza>
 */
class PizzaRepository extends ServiceEntityRepository
{
    // Deze functie wordt aangeroepen als we een nieuwe PizzaRepository maken
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pizza::class);
    }

    // Hieronder staan voorbeelden van functies die je kunt maken om pizza's op te halen

    //    /**
    //     * Deze functie zou een lijst van pizza's kunnen ophalen
    //     * @return Pizza[] Returns an array of Pizza objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    /**
    //     * Deze functie zou één specifieke pizza kunnen ophalen
    //     */
    //    public function findOneBySomeField($value): ?Pizza
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
