<?php
// Dit bestand maakt het contactformulier voor de website

namespace App\Form;

// We importeren alle benodigde onderdelen
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// Deze class maakt het contactformulier
class ContactType extends AbstractType
{
    // Deze functie bouwt het formulier op met alle velden
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Voeg een tekstveld toe voor de naam
            ->add('name', TextType::class, [
                'label' => 'Naam'
            ])
            // Voeg een e-mailveld toe
            ->add('email', EmailType::class, [
                'label' => 'E-mailadres'
            ])
            // Voeg een tekstveld toe voor het onderwerp
            ->add('subject', TextType::class, [
                'label' => 'Onderwerp'
            ])
            // Voeg een groot tekstveld toe voor het bericht
            ->add('message', TextareaType::class, [
                'label' => 'Bericht',
                'attr' => [
                    'rows' => 5
                ]
            ])
            // Voeg een verzendknop toe
            ->add('submit', SubmitType::class, [
                'label' => 'Versturen'
            ]);
    }

    // Deze functie koppelt het formulier aan de Contact class
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
} 