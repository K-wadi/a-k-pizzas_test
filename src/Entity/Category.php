<?php
// Dit bestand beschrijft hoe een pizza categorie eruitziet in de database

namespace App\Entity;

// We importeren alle benodigde onderdelen
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

// Dit is een database tabel voor categorieën
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    // Dit is het unieke nummer van de categorie
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Dit is de naam van de categorie
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // Dit zijn alle pizza's die bij deze categorie horen
    #[ORM\OneToMany(mappedBy: "category", targetEntity: Pizza::class)]
    private Collection $pizzas;

    // Dit wordt uitgevoerd als we een nieuwe categorie maken
    public function __construct()
    {
        // We maken een lege lijst voor de pizza's
        $this->pizzas = new ArrayCollection();
    }

    // Deze functie geeft het ID van de categorie terug
    public function getId(): ?int
    {
        return $this->id;
    }

    // Deze functie geeft de naam van de categorie terug
    public function getName(): ?string
    {
        return $this->name;
    }

    // Deze functie stelt de naam van de categorie in
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    // Deze functie geeft alle pizza's in deze categorie terug
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }
}

