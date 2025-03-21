<?php
// Dit bestand beschrijft hoe een pizza eruitziet in de database

namespace App\Entity;

// We importeren alle benodigde onderdelen
use App\Repository\PizzaRepository;
use Doctrine\ORM\Mapping as ORM;

// Dit is een database tabel voor pizza's
#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    // Dit is het unieke nummer van de pizza
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Dit is de naam van de pizza
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // Dit is de beschrijving van de pizza (kan leeg zijn)
    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    // Dit is de prijs van de pizza (met 2 decimalen)
    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private ?float $price = null;

    // Dit is de afbeelding van de pizza (kan leeg zijn)
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    // Dit is de categorie waar de pizza bij hoort
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: "pizzas")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    // Deze functie geeft het ID van de pizza terug
    public function getId(): ?int
    {
        return $this->id;
    }

    // Deze functie geeft de naam van de pizza terug
    public function getName(): ?string
    {
        return $this->name;
    }

    // Deze functie stelt de naam van de pizza in
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    // Deze functie geeft de beschrijving van de pizza terug
    public function getDescription(): ?string
    {
        return $this->description;
    }

    // Deze functie stelt de beschrijving van de pizza in
    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    // Deze functie geeft de prijs van de pizza terug
    public function getPrice(): ?float
    {
        return $this->price;
    }

    // Deze functie stelt de prijs van de pizza in
    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }

    // Deze functie geeft het pad naar de afbeelding van de pizza terug
    public function getImage(): ?string
    {
        if (!$this->image) {
            return null;
        }
        return '/img/' . $this->image;
    }

    // Deze functie stelt de afbeelding van de pizza in
    public function setImage(?string $image): static
    {
        // We verwijderen '/img/' van het begin als dat er staat
        $this->image = $image ? str_replace('/img/', '', $image) : null;
        return $this;
    }

    // Deze functie geeft de categorie van de pizza terug
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    // Deze functie stelt de categorie van de pizza in
    public function setCategory(?Category $category): static
    {
        $this->category = $category;
        return $this;
    }
}


