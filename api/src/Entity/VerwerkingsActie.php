<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Verwerkings actie.
 *
 * @ApiResource(
 *     attributes={"pagination_items_per_page"=30},
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "get_change_logs"={
 *              "path"="/verwerkings_acties/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/verwerkings_acties/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\VerwerkingsActieRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 *
 */
class VerwerkingsActie
{
    /**
     * @var UuidInterface The UUID identifier of this resource
     *
     * @example e2984465-190a-4562-829e-a8cca81aa35d
     *
     * @Assert\Uuid
     * @Groups({"read"})
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string The name of this processing action.
     *
     * @example Zoeken personen
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $actieNaam;

    /**
     * @var string The name of this processing action.
     *
     * @example Intake
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $handelingsNaam;

    /**
     * @var string The name of this processing action.
     *
     * @example Huwelijk
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $verwerkingsnaam;

    /**
     * @var string The name of this processing action.
     *
     * @example 48086bf2-11b7-4603-9526-67d7c3bb6587
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $verwerkingId;

    /**
     * @var string The name of this processing action.
     *
     * @example 5f0bef4c-f66f-4311-84a5-19e8bf359eaf
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $verwerkingsactiviteitId;

    /**
     * @var string The name of this processing action.
     *
     * @example https://loggingapi.vng.cloud/api/v1/verwerkingsactiviteiten/5f0bef4c-f66f-4311-84a5-19e8bf359eaf
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 2055
     * )
     * @Assert\Url()
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=2055, nullable=true)
     */
    private $verwerkingsactiviteitUrl;

    /**
     * @var string The name of this processing action.
     *
     * @example normaal
     *
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $vertrouwelijkheid;

    /**
     * @var string The name of this processing action.
     *
     * @example P10Y
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bewaartermijn;

    /**
     * @var string The name of this processing action.
     *
     * @example 00000001821002193000
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uitvoerder;

    /**
     * @var string The name of this processing action.
     *
     * @example FooBarApp v2.1
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $systeem;

    /**
     * @var string The name of this processing action.
     *
     * @example 123456789
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gebruiker;

    /**
     * @var string The name of this processing action.
     *
     * @example FooBar Database Publiekszaken
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gegevensbron;

    /**
     * @var string The name of this processing action.
     *
     * @example OIN
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $soortAfnemerId;

    /**
     * @var string The name of this processing action.
     *
     * @example 00000001821002193000
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $afnemerId;

    /**
     * @var string The name of this processing action.
     *
     * @example c5b9f4e7-8c79-41b9-91e2-6268419cb167
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $verwerkingsactiviteitIdAfnemer;

    /**
     * @var string The name of this processing action.
     *
     * @example https://www.amsterdam.nl/var/api/v1/verwerkingsactiviteiten/5f0bef4c-f66f-4311-84a5-19e8bf359eaf
     *
     * @Gedmo\Versioned
     * @Assert\Url()
     * @Assert\Length(
     *     max = 2055
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=2055, nullable=true)
     */
    private $verwerkingsactiviteitUrlAfnemer;

    /**
     * @var string The name of this processing action.
     *
     * @example 4b698de3-ffba-45e7-8697-a283ec863db2
     *
     * @Gedmo\Versioned
     * @Assert\Url()
     * @Assert\Length(
     *     max = 2055
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=2055, nullable=true)
     */
    private $verwerkingIdAfnemer;

    /**
     * @var Datetime The name of this processing action.
     *
     * @example 2024-04-05T14:35:42+01:00
     *
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime")
     */
    private $tijdstip;

    /**
     * @var Datetime The name of this processing action.
     *
     * @example 2024-04-05T14:35:42+01:00
     *
     * @Gedmo\Versioned
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $tijdstipRegistratie;

    /**
     * @var ArrayCollection Verwerkte objecten van deze verwerkings actie
     *
     * @Gedmo\Versioned
     * @Groups({"read", "write"})
     * @ORM\OneToMany(targetEntity="App\Entity\VerwerktObject", mappedBy="verwerkingsActie", cascade={"persist"})
     * @MaxDepth(1)
     */
    private $verwerkteObjecten;

    /**
     * @var Datetime The moment this request was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var Datetime The moment this request last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    public function __construct()
    {
        $this->verwerkteObjecten = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getActieNaam(): ?string
    {
        return $this->actieNaam;
    }

    public function setActieNaam(string $actieNaam): self
    {
        $this->actieNaam = $actieNaam;

        return $this;
    }

    public function getHandelingsNaam(): ?string
    {
        return $this->handelingsNaam;
    }

    public function setHandelingsNaam(string $handelingsNaam): self
    {
        $this->handelingsNaam = $handelingsNaam;

        return $this;
    }

    public function getVerwerkingsNaam(): ?string
    {
        return $this->verwerkingsnaam;
    }

    public function setVerwerkingsNaam(string $verwerkingsnaam): self
    {
        $this->verwerkingsnaam = $verwerkingsnaam;

        return $this;
    }

    public function getVerwerkingId(): ?string
    {
        return $this->verwerkingId;
    }

    public function setVerwerkingId(string $verwerkingId): self
    {
        $this->verwerkingId = $verwerkingId;

        return $this;
    }

    public function getVerwerkingsactiviteitId(): ?string
    {
        return $this->verwerkingsactiviteitId;
    }

    public function setVerwerkingsactiviteitId(string $verwerkingsactiviteitId): self
    {
        $this->verwerkingsactiviteitId = $verwerkingsactiviteitId;

        return $this;
    }

    public function getVerwerkingsactiviteitUrl(): ?string
    {
        return $this->verwerkingsactiviteitUrl;
    }

    public function setVerwerkingsactiviteitUrl(string $verwerkingsactiviteitUrl): self
    {
        $this->verwerkingsactiviteitUrl = $verwerkingsactiviteitUrl;

        return $this;
    }

    public function getVertrouwelijkheid(): ?string
    {
        return $this->vertrouwelijkheid;
    }

    public function setVertrouwelijkheid(string $vertrouwelijkheid): self
    {
        $this->vertrouwelijkheid = $vertrouwelijkheid;

        return $this;
    }

    public function getBewaartermijn(): ?string
    {
        return $this->bewaartermijn;
    }

    public function setBewaartermijn(string $bewaartermijn): self
    {
        $this->bewaartermijn = $bewaartermijn;

        return $this;
    }

    public function getUitvoerder(): ?string
    {
        return $this->uitvoerder;
    }

    public function setUitvoerder(string $uitvoerder): self
    {
        $this->uitvoerder = $uitvoerder;

        return $this;
    }

    public function getSysteem(): ?string
    {
        return $this->systeem;
    }

    public function setSysteem(string $systeem): self
    {
        $this->systeem = $systeem;

        return $this;
    }

    public function getGebruiker(): ?string
    {
        return $this->gebruiker;
    }

    public function setGebruiker(string $gebruiker): self
    {
        $this->gebruiker = $gebruiker;

        return $this;
    }

    public function getGegevensbron(): ?string
    {
        return $this->gegevensbron;
    }

    public function setGegevensbron(string $gegevensbron): self
    {
        $this->gegevensbron = $gegevensbron;

        return $this;
    }

    public function getSoortAfnemerId(): ?string
    {
        return $this->soortAfnemerId;
    }

    public function setSoortAfnemerId(string $soortAfnemerId): self
    {
        $this->soortAfnemerId = $soortAfnemerId;

        return $this;
    }

    public function getAfnemerId(): ?string
    {
        return $this->afnemerId;
    }

    public function setAfnemerId(string $afnemerId): self
    {
        $this->afnemerId = $afnemerId;

        return $this;
    }

    public function getVerwerkingsactiviteitIdAfnemer(): ?string
    {
        return $this->verwerkingsactiviteitIdAfnemer;
    }

    public function setVerwerkingsactiviteitIdAfnemer(string $verwerkingsactiviteitIdAfnemer): self
    {
        $this->verwerkingsactiviteitIdAfnemer = $verwerkingsactiviteitIdAfnemer;

        return $this;
    }

    public function getVerwerkingsactiviteitUrlAfnemer(): ?string
    {
        return $this->verwerkingsactiviteitUrlAfnemer;
    }

    public function setVerwerkingsactiviteitUrlAfnemer(string $verwerkingsactiviteitUrlAfnemer): self
    {
        $this->verwerkingsactiviteitUrlAfnemer = $verwerkingsactiviteitUrlAfnemer;

        return $this;
    }

    public function getVerwerkingIdAfnemer(): ?string
    {
        return $this->verwerkingIdAfnemer;
    }

    public function setVerwerkingIdAfnemer(string $verwerkingIdAfnemer): self
    {
        $this->verwerkingIdAfnemer = $verwerkingIdAfnemer;

        return $this;
    }

    public function getTijdstip(): ?\DateTimeInterface
    {
        return $this->tijdstip;
    }

    public function setTijdstip(\DateTimeInterface $tijdstip): self
    {
        $this->tijdstip = $tijdstip;

        return $this;
    }

    public function getTijdstipRegistratie(): ?\DateTimeInterface
    {
        return $this->tijdstipRegistratie;
    }

    public function setTijdstipRegistratie(\DateTimeInterface $tijdstipRegistratie): self
    {
        $this->tijdstipRegistratie = $tijdstipRegistratie;

        return $this;
    }

    /**
     * @return Collection|VerwerktObject[]
     */
    public function getVerwerktObjects(): Collection
    {
        return $this->verwerkteObjecten;
    }

    public function addVerwerktObject(VerwerktObject $verwerktObject): self
    {
        if (!$this->verwerkteObjecten->contains($verwerktObject)) {
            $this->verwerkteObjecten[] = $verwerktObject;
            $verwerktObject->setVerwerkingsActie($this);
        }

        return $this;
    }

    public function removeVerwerktObject(VerwerktObject $verwerktObject): self
    {
        if ($this->verwerkteObjecten->contains($verwerktObject)) {
            $this->verwerkteObjecten->removeElement($verwerktObject);
            // set the owning side to null (unless already changed)
            if ($verwerktObject->getVerwerkingsActie() === $this) {
                $verwerktObject->setVerwerkingsActie(null);
            }
        }

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }
}
