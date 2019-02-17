<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HeroDiabloRepository")
 */
class HeroDiablo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BattleTag;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Parangon;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ParaSaison;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Kills;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Elites;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idProfil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBattleTag(): ?string
    {
        return $this->BattleTag;
    }

    public function setBattleTag(?string $BattleTag): self
    {
        $this->BattleTag = $BattleTag;

        return $this;
    }

    public function getParangon(): ?int
    {
        return $this->Parangon;
    }

    public function setParangon(?int $Parangon): self
    {
        $this->Parangon = $Parangon;

        return $this;
    }

    public function getParaSaison(): ?int
    {
        return $this->ParaSaison;
    }

    public function setParaSaison(?int $ParaSaison): self
    {
        $this->ParaSaison = $ParaSaison;

        return $this;
    }

    public function getKills(): ?int
    {
        return $this->Kills;
    }

    public function setKills(?int $Kills): self
    {
        $this->Kills = $Kills;

        return $this;
    }

    public function getElites(): ?int
    {
        return $this->Elites;
    }

    public function setElites(?int $Elites): self
    {
        $this->Elites = $Elites;

        return $this;
    }

    public function getIdProfil(): ?int
    {
        return $this->idProfil;
    }

    public function setIdProfil(?int $idProfil): self
    {
        $this->idProfil = $idProfil;

        return $this;
    }
}
