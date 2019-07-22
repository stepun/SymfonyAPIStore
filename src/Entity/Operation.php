<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OperationRepository")
 * @ApiResource()
 */
class Operation
{
    const TYPE_WRITE_OFF = 1;
    const TYPE_INCOMING = 2;

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
     * @ORM\Column(type="integer", options={"default" : 1, "comment":"Operation type: (1 == Write-off), (2 ==incoming)"})
     * @Assert\Choice(
     *     choices = { 1, 2 },
     *     message = "Operation must be only 1 (Write-off) or 2 (Incoming)."
     * )
     */
    private $type;


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

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Operation
     */
    public function setType(int $type): self
    {
        if (!in_array($type, array(self::TYPE_WRITE_OFF, self::TYPE_INCOMING))) {
            throw new InvalidArgumentException("Invalid operation type $type. 
            Must take value: " . self::TYPE_WRITE_OFF . " or " . self::TYPE_INCOMING);
        }
        $this->type = $type;

        return $this;
    }

}
