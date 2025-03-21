<?php
// Dit bestand regelt alles wat met het tonen van pizza's te maken heeft

namespace App\Controller;

// We importeren alle benodigde onderdelen
use App\Entity\Category;
use App\Entity\Pizza;
use App\Repository\CategoryRepository;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Alle routes in deze controller beginnen met /pizza
#[Route('/pizza')]
class PizzaController extends AbstractController
{
    // Deze functie toont het overzicht van alle pizza's
    #[Route('/', name: 'pizza_index')]
    public function index(PizzaRepository $pizzaRepository, CategoryRepository $categoryRepository): Response
    {
        // We sturen alle pizza's en categorieën naar de template
        return $this->render('pizza/index.html.twig', [
            'pizzas' => $pizzaRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    // Deze functie toont alle pizza's van een bepaalde categorie
    #[Route('/category/{id}', name: 'pizza_category')]
    public function category(Category $category): Response
    {
        // We sturen de categorie en bijbehorende pizza's naar de template
        return $this->render('pizza/category.html.twig', [
            'category' => $category,
            'pizzas' => $category->getPizzas(),
        ]);
    }

    // Deze functie toont de details van één specifieke pizza
    #[Route('/{id}', name: 'pizza_show')]
    public function show(Pizza $pizza): Response
    {
        // We sturen de pizza-informatie naar de template
        return $this->render('pizza/show.html.twig', [
            'pizza' => $pizza,
        ]);
    }
}

