<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ApiResource()
 */
class Product
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
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false, options={"default" : 0})
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Measure")
     * @ORM\JoinColumn(nullable=false)
     */
    private $measure;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Instock", mappedBy="product")
     */
    private $instocks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="product")
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

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeasure()
    {
        return $this->measure;
    }

    public function setMeasure(Measure $measure)
    {
        $this->measure = $measure;
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
