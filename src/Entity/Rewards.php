<?php

namespace App\Entity;

use App\Repository\RewardsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RewardsRepository::class)
 */
class Rewards
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
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    private $Points;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img;

    /**
     * @ORM\OneToMany(targetEntity=CommandeReward::class, mappedBy="Reward")
     */
    private $commandeRewards;

    public function __construct()
    {
        $this->commandeRewards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->Points;
    }

    public function setPoints(int $Points): self
    {
        $this->Points = $Points;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    /**
     * @return Collection|CommandeReward[]
     */
    public function getCommandeRewards(): Collection
    {
        return $this->commandeRewards;
    }

    public function addCommandeReward(CommandeReward $commandeReward): self
    {
        if (!$this->commandeRewards->contains($commandeReward)) {
            $this->commandeRewards[] = $commandeReward;
            $commandeReward->setReward($this);
        }

        return $this;
    }

    public function removeCommandeReward(CommandeReward $commandeReward): self
    {
        if ($this->commandeRewards->removeElement($commandeReward)) {
            // set the owning side to null (unless already changed)
            if ($commandeReward->getReward() === $this) {
                $commandeReward->setReward(null);
            }
        }

        return $this;
    }
}
