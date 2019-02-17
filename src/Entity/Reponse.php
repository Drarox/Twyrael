<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idMessage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idUserPrive;

    /**
     * @ORM\Column(type="integer")
     */
    private $idUserCreation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMessage(): ?int
    {
        return $this->idMessage;
    }

    public function setIdMessage(int $idMessage): self
    {
        $this->idMessage = $idMessage;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getIdUserPrive(): ?int
    {
        return $this->idUserPrive;
    }

    public function setIdUserPrive(?int $idUserPrive): self
    {
        $this->idUserPrive = $idUserPrive;

        return $this;
    }

    public function getIdUserCreation(): ?int
    {
        return $this->idUserCreation;
    }

    public function setIdUserCreation(int $idUserCreation): self
    {
        $this->idUserCreation = $idUserCreation;

        return $this;
    }
}
