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
 * Verwerkt object.
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
 *              "path"="/verwerkt_objects/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/verwerkt_objects/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\VerwerktObjectRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 *
 */
class VerwerktObject
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
     * @var string Het type van dit verwerkte object
     *
     * @example persoon
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $objecttype;

    /**
     * @var string Het soort id van dit verwerkte object
     *
     * @example BSN
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $soortObjectId;

    /**
     * @var string Het object id naast het lokale id
     *
     * @example 1234567
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $objectId;

    /**
     * @var string De betrokkenheid van dit verwerkte object
     *
     * @example 1234567
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $betrokkenheid;

    /**
     * @var VerwerkingsActie Verwerkings actie van dit verwerkt object
     *
     * @Groups({"write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\VerwerkingsActie", inversedBy="verwerkteObjecten", cascade={"persist"})
     * @MaxDepth(1)
     */
    private $verwerkingsActie;
    /**
     * @var ArrayCollection Verwerkte soort gegevens verwerkt object
     *
     * @Groups({"read", "write"})
     * @ORM\OneToMany(targetEntity="App\Entity\VerwerktSoortGegeven", mappedBy="verwerktObject", cascade={"persist"})
     * @MaxDepth(1)
     */
    private $verwerkteSoortGegevens;

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
        $this->verwerkteSoortGegevens = new ArrayCollection();
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

    public function getObjectType(): ?string
    {
        return $this->objecttype;
    }

    public function setObjectType(string $objecttype): self
    {
        $this->objecttype = $objecttype;

        return $this;
    }

    public function getSoortObjectId(): ?string
    {
        return $this->soortObjectId;
    }

    public function setSoortObjectId(string $soortObjectId): self
    {
        $this->soortObjectId = $soortObjectId;

        return $this;
    }

    public function getObjectId(): ?string
    {
        return $this->objectId;
    }

    public function setObjectId(string $objectId): self
    {
        $this->objectId = $objectId;

        return $this;
    }

    public function getBetrokkenheid(): ?string
    {
        return $this->betrokkenheid;
    }

    public function setBetrokkenheid(string $betrokkenheid): self
    {
        $this->betrokkenheid = $betrokkenheid;

        return $this;
    }

    public function getVerwerkingsActie(): ?VerwerkingsActie
    {
        return $this->verwerkingsActie;
    }

    public function setVerwerkingsActie(?VerwerkingsActie $verwerkingsActie): self
    {
        $this->verwerkingsActie = $verwerkingsActie;

        return $this;
    }

    /**
     * @return Collection|VerwerktSoortGegeven[]
     */
    public function getVerwerkteSoortGegevens(): Collection
    {
        return $this->verwerkteSoortGegevens;
    }

    public function addVerwerktSoortGegeven(VerwerktSoortGegeven $verwerktSoortGegeven): self
    {
        if (!$this->verwerkteSoortGegevens->contains($verwerktSoortGegeven)) {
            $this->verwerkteSoortGegevens[] = $verwerktSoortGegeven;
            $verwerktSoortGegeven->setVerwerktObject($this);
        }

        return $this;
    }

    public function removeVerwerktSoortGegeven(VerwerktSoortGegeven $verwerktSoortGegeven): self
    {
        if ($this->verwerkteSoortGegevens->contains($verwerktSoortGegeven)) {
            $this->verwerkteSoortGegevens->removeElement($verwerktSoortGegeven);
            // set the owning side to null (unless already changed)
            if ($verwerktSoortGegeven->getVerwerktObject() === $this) {
                $verwerktSoortGegeven->setVerwerktObject(null);
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
