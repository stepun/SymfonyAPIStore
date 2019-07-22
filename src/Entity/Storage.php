<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StorageRepository")
 * @ApiResource()
 */
class Storage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Instock", mappedBy="storage")
     */
    private $instocks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="storage")
     */
    private $transactions;

    public function __construct()
    {
        $this->instocks = new ArrayCollection();
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Instock[]
     */
    public function getInstocks()
    {
        return $this->instocks;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}
