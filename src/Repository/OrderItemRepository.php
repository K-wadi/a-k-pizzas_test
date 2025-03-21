<?php
// Dit bestand zorgt voor het ophalen van bestelitems uit de database

namespace App\Repository;

// We importeren alle benodigde onderdelen
use App\Entity\OrderItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Deze class zorgt voor het ophalen van bestelitems uit de database
 * @extends ServiceEntityRepository<OrderItem>
 */
class OrderItemRepository extends ServiceEntityRepository
{
    // Deze functie wordt aangeroepen als we een nieuwe OrderItemRepository maken
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderItem::class);
    }

    // Hieronder staan voorbeelden van functies die je kunt maken om bestelitems op te halen

    //    /**
    //     * Deze functie zou een lijst van bestelitems kunnen ophalen
    //     * @return OrderItem[] Returns an array of OrderItem objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    /**
    //     * Deze functie zou één specifiek bestelitem kunnen ophalen
    //     */
    //    public function findOneBySomeField($value): ?OrderItem
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
