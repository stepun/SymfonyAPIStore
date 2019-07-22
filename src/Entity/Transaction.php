<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateTransaction;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
{
"price": "12.20",
"product": {"@id":"/api/products/1"},
"storage": {"@id":"/api/storages/1"},
"operation": {"@id":"/api/operations/1"},
"documentNumber": "1/05",
"documentDate": "2019-05-30",
"quantityItem": 1
}
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 * @ApiResource(
 *     collectionOperations={
 *     "get",
 *     "post"={
 *         "method"="POST",
 *         "controller"=CreateTransaction::class,
 *        }
 *     },
 *     itemOperations={
 *      "get","put"
 *     }
 *     )
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="date", nullable=false)
     * @Assert\NotNull
     */
    private $document_date;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotNull
     */
    private $document_number;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false, options={"default" : 0})
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Operation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $operation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Storage", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $storage;

    /**
     * @ORM\Column(type="float", nullable=false, options={"default" : 0})
     * @Assert\NotNull
     */
    private $quantity_item;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDocumentDate()
    {
        return $this->document_date;
    }

    /**
     * @param mixed $document_date
     * @return Transaction
     */
    public function setDocumentDate($document_date): self
    {
        $this->document_date = $document_date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumentNumber()
    {
        return $this->document_number;
    }

    /**
     * @param mixed $document_number
     * @return Transaction
     */
    public function setDocumentNumber($document_number): self
    {
        $this->document_number = $document_number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Transaction
     */
    public function setPrice($price): self
    {
        $this->price = $price;
        return $this;
    }


    /**
     * @return Collection|Operation[]
     */
    public function getOperation()
    {
        return $this->operation;
    }

    public function setOperation(Operation $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Collection|Storage[]
     */
    public function getStorage()
    {
        return $this->storage;
    }

    public function setStorage(Storage $storage): self
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantityItem()
    {
        return $this->quantity_item;
    }

    /**
     * @param mixed $quantity_item
     * @return Transaction
     */
    public function setQuantityItem($quantity_item): self
    {
        $this->quantity_item = $quantity_item;
        return $this;
    }
}
