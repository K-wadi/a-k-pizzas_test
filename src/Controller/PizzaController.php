<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pizza')]
class PizzaController extends AbstractController
{
    #[Route('/', name: 'pizza_index')]
    public function index(PizzaRepository $pizzaRepository): Response
    {
        return $this->render('pizza/index.html.twig', [
            'pizzas' => $pizzaRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'pizza_show')]
    public function show(Pizza $pizza): Response
    {
        return $this->render('pizza/show.html.twig', [
            'pizza' => $pizza,
        ]);
    }
}

