<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Pizza;
use App\Repository\CategoryRepository;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pizza')]
class PizzaController extends AbstractController
{
    #[Route('/pizza', name: 'pizza_index')]
    public function index(PizzaRepository $pizzaRepository): Response
    {
        return $this->render('pizza/index.html.twig', [
            'pizzas' => $pizzaRepository->findAll(),
        ]);
    }

    #[Route('/pizza/{id}', name: 'pizza_show')]
    public function show(int $id, PizzaRepository $pizzaRepository): Response
    {
        $pizza = $pizzaRepository->find($id);

        if (!$pizza) {
            throw $this->createNotFoundException('Pizza niet gevonden!');
        }

        return $this->render('pizza/show.html.twig', [
            'pizza' => $pizza,
        ]);
    }

    #[Route('/pizza/categories', name: 'pizza_categories')]
    public function categories(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('pizza/categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/pizza/category/{id}', name: 'pizza_category')]
    public function category(int $id, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Categorie niet gevonden');
        }

        return $this->render('pizza/category.html.twig', [
            'category' => $category,
            'pizzas' => $category->getPizzas(),
        ]);
    }
}

