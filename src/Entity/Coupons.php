<?php

namespace App\Entity;

use App\Repository\CouponsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CouponsRepository::class)
 */
class Coupons
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity=NGO::class, inversedBy="coupons")
     */
    private $NGO;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="coupons")
     */
    private $Product;

    /**
     * @ORM\Column(type="integer")
     */
    private $Percentage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNGO(): ?NGO
    {
        return $this->NGO;
    }

    public function setNGO(?NGO $NGO): self
    {
        $this->NGO = $NGO;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->Product;
    }

    public function setProduct(?Product $Product): self
    {
        $this->Product = $Product;

        return $this;
    }

    public function getPercentage(): ?int
    {
        return $this->Percentage;
    }

    public function setPercentage(int $Percentage): self
    {
        $this->Percentage = $Percentage;

        return $this;
    }
}
