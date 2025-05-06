<?php

namespace App\Model\Entity;

class EvenementEntity extends AbstractEntity
{
    private ?int $Id_evenement = null;
    private string $evenement_titre;
    private string $evenement_description;
    private string $evenement_date;
    private int $idVilleFR;

    // Getters et setters
    public function getIdEvenement(): ?int
    {
        return $this->Id_evenement;
    }

    public function setIdEvenement(int $Id_evenement): self
    {
        $this->Id_evenement = $Id_evenement;
        return $this;
    }

    public function getEvenementTitre(): string
    {
        return $this->evenement_titre;
    }

    public function setEvenementTitre(string $evenement_titre): self
    {
        if (empty($evenement_titre)) {
            throw new \InvalidArgumentException("Le titre de l'événement ne peut pas être vide.");
        }
        $this->evenement_titre = $evenement_titre;
        return $this;
    }

    public function getEvenementDescription(): string
    {
        return $this->evenement_description;
    }

    public function setEvenementDescription(string $evenement_description): self
    {
        if (empty($evenement_description)) {
            throw new \InvalidArgumentException("La description de l'événement ne peut pas être vide.");
        }
        $this->evenement_description = $evenement_description;
        return $this;
    }

    public function getEvenementDate(): string
    {
        return $this->evenement_date;
    }

    public function setEvenementDate(string $evenement_date): self
    {
        if (!strtotime($evenement_date)) {
            throw new \InvalidArgumentException("Le format de la date est invalide.");
        }
        $this->evenement_date = $evenement_date;
        return $this;
    }

    public function getIdVilleFR(): int
    {
        return $this->idVilleFR;
    }

    public function setIdVilleFR(int $idVilleFR): self
    {
        if ($idVilleFR <= 0) {
            throw new \InvalidArgumentException("L'ID de la ville doit être un entier positif.");
        }
        $this->idVilleFR = $idVilleFR;
        return $this;
    }
    
}
