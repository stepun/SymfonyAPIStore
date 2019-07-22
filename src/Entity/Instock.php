<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstockRepository")
 * @ApiResource()
 */
class Instock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $balance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Storage", inversedBy="instocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $storage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="instocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setBalance($balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param mixed $storage
     * @return Instock
     */
    public function setStorage($storage): self
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     * @return Instock
     */
    public function setProduct($product): self
    {
        $this->product = $product;
        return $this;
    }
}
