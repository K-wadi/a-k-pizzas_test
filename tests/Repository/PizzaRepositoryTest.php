<?php

namespace App\Tests\Repository;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PizzaRepositoryTest extends KernelTestCase
{
    public function testFindAllReturnsPizzas(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $pizzaRepository = $container->get(PizzaRepository::class);

        $pizzas = $pizzaRepository->findAll();
        $this->assertIsArray($pizzas);
    }
}
