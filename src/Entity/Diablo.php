<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiabloRepository")
 */
class Diablo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BattleTag;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getBattleTag(): ?string
    {
        return $this->BattleTag;
    }

    public function setBattleTag(string $BattleTag): self
    {
        $this->BattleTag = $BattleTag;

        return $this;
    }
}
