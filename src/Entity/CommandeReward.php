<?php

namespace App\Entity;

use App\Repository\CommandeRewardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRewardRepository::class)
 */
class CommandeReward
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Rewards::class, inversedBy="commandeRewards")
     */
    private $Reward;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandeRewards")
     */
    private $User;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Addresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReward(): ?Rewards
    {
        return $this->Reward;
    }

    public function setReward(?Rewards $Reward): self
    {
        $this->Reward = $Reward;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->Addresse;
    }

    public function setAddresse(string $Addresse): self
    {
        $this->Addresse = $Addresse;

        return $this;
    }
}
