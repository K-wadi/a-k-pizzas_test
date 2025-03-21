<?php
// Dit bestand zorgt voor het ophalen van bestellingen uit de database

namespace App\Repository;

// We importeren alle benodigde onderdelen
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Deze class zorgt voor het ophalen van bestellingen uit de database
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    // Deze functie wordt aangeroepen als we een nieuwe OrderRepository maken
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    // Deze functie haalt alle bestellingen op, gesorteerd op datum (nieuwste eerst)
    public function findAllOrders(): array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // Hieronder staan voorbeelden van functies die je kunt maken om bestellingen op te halen

    //    /**
    //     * Deze functie zou een lijst van bestellingen kunnen ophalen
    //     * @return Order[] Returns an array of Order objects
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
    //     * Deze functie zou één specifieke bestelling kunnen ophalen
    //     */
    //    public function findOneBySomeField($value): ?Order
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
