<?php
// Dit bestand regelt het contactformulier van de website

namespace App\Controller;

// We importeren alle benodigde onderdelen
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Deze controller zorgt voor het afhandelen van contactberichten
class ContactController extends AbstractController
{
    // Deze functie toont en verwerkt het contactformulier
    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // We maken een nieuw leeg contactbericht aan
        $contact = new Contact();
        // We maken het formulier aan
        $form = $this->createForm(ContactType::class, $contact);
        // We verwerken de ingediende gegevens
        $form->handleRequest($request);

        // Als het formulier is verzonden en alle gegevens kloppen
        if ($form->isSubmitted() && $form->isValid()) {
            // We slaan het bericht op in de database
            $entityManager->persist($contact);
            $entityManager->flush();

            // We tonen een succesbericht aan de gebruiker
            $this->addFlash('success', 'Uw bericht is succesvol verzonden. We nemen zo spoedig mogelijk contact met u op.');
            // We sturen de gebruiker terug naar de contactpagina
            return $this->redirectToRoute('contact');
        }

        // We tonen het formulier aan de gebruiker
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
} 