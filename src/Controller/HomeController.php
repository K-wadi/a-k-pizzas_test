<?php
// Dit bestand regelt de homepage van de website

namespace App\Controller;

// We importeren de benodigde Symfony onderdelen
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Deze controller zorgt voor de homepage
class HomeController extends AbstractController
{
    // Dit zorgt ervoor dat deze functie wordt aangeroepen als iemand naar de homepage (/) gaat
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        // We laten de homepage zien door de template te laden
        return $this->render('home/index.html.twig');
    }
}
