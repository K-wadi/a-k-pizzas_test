<?php
// Dit bestand beschrijft hoe een bestelling eruitziet in de database

namespace App\Entity;

// We importeren alle benodigde onderdelen
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// Dit is een database tabel voor bestellingen
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    // Dit is het unieke nummer van de bestelling
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Dit is de naam van de klant
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Vul uw naam in')]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Uw naam moet minimaal {{ limit }} karakters bevatten',
        maxMessage: 'Uw naam mag maximaal {{ limit }} karakters bevatten'
    )]
    private ?string $customerName = null;

    // Dit is het e-mailadres van de klant
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Vul uw e-mailadres in')]
    #[Assert\Email(message: 'Het e-mailadres "{{ value }}" is niet geldig')]
    private ?string $customerEmail = null;

    // Dit is het telefoonnummer van de klant
    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank(message: 'Vul uw telefoonnummer in')]
    #[Assert\Regex(
        pattern: '/^[0-9\-\+\s\(\)]{10,20}$/',
        message: 'Vul een geldig telefoonnummer in'
    )]
    private ?string $customerPhone = null;

    // Dit is het bezorgadres van de klant
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Vul uw bezorgadres in')]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'Het adres moet minimaal {{ limit }} karakters bevatten',
        maxMessage: 'Het adres mag maximaal {{ limit }} karakters bevatten'
    )]
    private ?string $deliveryAddress = null;

    // Dit is de datum en tijd waarop de bestelling is geplaatst
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    // Dit zijn alle items (pizza's) in de bestelling
    #[ORM\OneToMany(mappedBy: "order", targetEntity: OrderItem::class, cascade: ["persist", "remove"])]
    private Collection $orderItems;

    // Dit is de status van de bestelling (To Do, In Progress, Done)
    #[ORM\Column(length: 255)]
    private ?string $status = "To Do";

    // Dit is het unieke bestelnummer
    #[ORM\Column(length: 20, unique: true)]
    private ?string $orderReference = null;

    // Dit wordt uitgevoerd als we een nieuwe bestelling maken
    public function __construct()
    {
        // We maken een lege lijst voor de bestelde items
        $this->orderItems = new ArrayCollection();
        // We zetten de besteldatum op nu
        $this->createdAt = new \DateTimeImmutable();
        // We maken een uniek bestelnummer
        $this->orderReference = strtoupper(uniqid('ORD-'));
    }

    // Deze functie geeft het ID van de bestelling terug
    public function getId(): ?int
    {
        return $this->id;
    }

    // Deze functie geeft de naam van de klant terug
    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    // Deze functie stelt de naam van de klant in
    public function setCustomerName(string $customerName): static
    {
        $this->customerName = $customerName;
        return $this;
    }

    // Deze functie geeft het e-mailadres van de klant terug
    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    // Deze functie stelt het e-mailadres van de klant in
    public function setCustomerEmail(string $customerEmail): static
    {
        $this->customerEmail = $customerEmail;
        return $this;
    }

    // Deze functie geeft het telefoonnummer van de klant terug
    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }

    // Deze functie stelt het telefoonnummer van de klant in
    public function setCustomerPhone(string $customerPhone): static
    {
        $this->customerPhone = $customerPhone;
        return $this;
    }

    // Deze functie geeft het bezorgadres van de klant terug
    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    // Deze functie stelt het bezorgadres van de klant in
    public function setDeliveryAddress(string $deliveryAddress): static
    {
        $this->deliveryAddress = $deliveryAddress;
        return $this;
    }

    // Deze functie geeft de besteldatum en -tijd terug
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    // Deze functie stelt de besteldatum en -tijd in
    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    // Deze functie geeft alle bestelde items terug
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    // Deze functie voegt een item toe aan de bestelling
    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems[] = $orderItem;
            $orderItem->setOrder($this);
        }
        return $this;
    }

    // Deze functie geeft de status van de bestelling terug
    public function getStatus(): ?string
    {
        return $this->status;
    }

    // Deze functie stelt de status van de bestelling in
    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }

    // Deze functie geeft het bestelnummer terug
    public function getOrderReference(): ?string
    {
        return $this->orderReference;
    }

    // Deze functie stelt het bestelnummer in
    public function setOrderReference(string $orderReference): static
    {
        $this->orderReference = $orderReference;
        return $this;
    }
}
