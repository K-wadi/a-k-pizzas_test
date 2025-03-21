<?php
// Dit bestand maakt het bestelformulier voor de website

namespace App\Form;

// We importeren alle benodigde onderdelen
use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

// Deze class maakt het bestelformulier
class OrderType extends AbstractType
{
    // Deze functie bouwt het formulier op met alle velden
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Voeg een tekstveld toe voor de naam van de klant
            ->add('customerName', TextType::class, [
                'constraints' => [
                    // De naam moet ingevuld zijn
                    new Assert\NotBlank([
                        'message' => 'Vul uw naam in'
                    ]),
                    // De naam moet tussen 2 en 50 tekens lang zijn
                    new Assert\Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Uw naam moet minimaal {{ limit }} karakters bevatten',
                        'maxMessage' => 'Uw naam mag maximaal {{ limit }} karakters bevatten'
                    ])
                ]
            ])
            // Voeg een e-mailveld toe voor het e-mailadres van de klant
            ->add('customerEmail', EmailType::class, [
                'constraints' => [
                    // Het e-mailadres moet ingevuld zijn
                    new Assert\NotBlank([
                        'message' => 'Vul uw e-mailadres in'
                    ]),
                    // Het e-mailadres moet geldig zijn
                    new Assert\Email([
                        'message' => 'Het e-mailadres "{{ value }}" is niet geldig'
                    ])
                ]
            ])
            // Voeg een telefoonnummerveld toe voor het telefoonnummer van de klant
            ->add('customerPhone', TelType::class, [
                'constraints' => [
                    // Het telefoonnummer moet ingevuld zijn
                    new Assert\NotBlank([
                        'message' => 'Vul uw telefoonnummer in'
                    ]),
                    // Het telefoonnummer moet geldig zijn (10-20 tekens, alleen cijfers en speciale tekens)
                    new Assert\Regex([
                        'pattern' => '/^[0-9\-\+\s\(\)]{10,20}$/',
                        'message' => 'Vul een geldig telefoonnummer in'
                    ])
                ]
            ])
            // Voeg een tekstveld toe voor het bezorgadres van de klant
            ->add('deliveryAddress', TextType::class, [
                'constraints' => [
                    // Het adres moet ingevuld zijn
                    new Assert\NotBlank([
                        'message' => 'Vul uw bezorgadres in'
                    ]),
                    // Het adres moet tussen 5 en 255 tekens lang zijn
                    new Assert\Length([
                        'min' => 5,
                        'max' => 255,
                        'minMessage' => 'Het adres moet minimaal {{ limit }} karakters bevatten',
                        'maxMessage' => 'Het adres mag maximaal {{ limit }} karakters bevatten'
                    ])
                ]
            ])
            // Voeg een verzendknop toe
            ->add('submit', SubmitType::class);
    }

    // Deze functie koppelt het formulier aan de Order class
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
} 