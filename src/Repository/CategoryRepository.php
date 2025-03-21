<?php
// Dit bestand zorgt voor het ophalen van categorieën uit de database

namespace App\Repository;

// We importeren alle benodigde onderdelen
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Deze class zorgt voor het ophalen van categorieën uit de database
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    // Deze functie wordt aangeroepen als we een nieuwe CategoryRepository maken
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    // Hieronder staan voorbeelden van functies die je kunt maken om categorieën op te halen

    //    /**
    //     * Deze functie zou een lijst van categorieën kunnen ophalen
    //     * @return Category[] Returns an array of Category objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    /**
    //     * Deze functie zou één specifieke categorie kunnen ophalen
    //     */
    //    public function findOneBySomeField($value): ?Category
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
