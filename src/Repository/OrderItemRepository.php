<?php

namespace App\Repository;

use App\Entity\OrderItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderItem>
 *
 * @method OrderItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderItem[]    findAll()
 * @method OrderItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderItem::class);
    }

    /**
     * Zoek alle items voor een specifieke bestelling.
     */
    public function findByOrder(int $orderId): array
    {
        return $this->createQueryBuilder('oi')
            ->andWhere('oi.order = :orderId')
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->getResult();
    }

    /**
     * Verwijdert alle items van een specifieke bestelling.
     */
    public function removeItemsByOrder(int $orderId): void
    {
        $this->createQueryBuilder('oi')
            ->delete()
            ->where('oi.order = :orderId')
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->execute();
    }
}
