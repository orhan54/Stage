<?php

namespace App\Model\Entity;

class VilleFREntity extends AbstractEntity
{
    protected ?int $id_villeFR = null;
    protected ?int $ville_departement = null;
    protected ?string $ville_nom = null;
    protected ?string $ville_nom_simple = null;
    protected ?string $ville_nom_reel = null;
    protected ?int $ville_code_postal = null;
    protected ?int $id_departement = null;

    // GETTERS

    public function getIdVilleFR(): ?int
    {
        return $this->id_villeFR;
    }

    public function getVilleDepartement(): ?int
    {
        return $this->ville_departement;
    }

    public function getVilleNom(): ?string
    {
        return $this->ville_nom;
    }

    public function getVilleNomSimple(): ?string
    {
        return $this->ville_nom_simple;
    }

    public function getVilleNomReel(): ?string
    {
        return $this->ville_nom_reel;
    }

    public function getVilleCodePostal(): ?int
    {
        return $this->ville_code_postal;
    }

    public function getIdDepartement(): ?int
    {
        return $this->id_departement;
    }

    // SETTERS

    public function setIdVilleFR(int $id_villeFR): self
    {
        $this->id_villeFR = $id_villeFR;
        return $this;
    }

    public function setVilleDepartement(int $ville_departement): self
    {
        if ($ville_departement <= 0) {
            throw new \InvalidArgumentException("Le département de la ville doit être un entier positif.");
        }
        $this->ville_departement = $ville_departement;
        return $this;
    }

    public function setVilleNom(string $ville_nom): self
    {
        if (empty($ville_nom)) {
            throw new \InvalidArgumentException("Le nom de la ville ne peut pas être vide.");
        }
        $this->ville_nom = $ville_nom;
        return $this;
    }

    public function setVilleNomSimple(string $ville_nom_simple): self
    {
        if (empty($ville_nom_simple)) {
            throw new \InvalidArgumentException("Le nom simple de la ville ne peut pas être vide.");
        }
        $this->ville_nom_simple = $ville_nom_simple;
        return $this;
    }

    public function setVilleNomReel(string $ville_nom_reel): self
    {
        if (empty($ville_nom_reel)) {
            throw new \InvalidArgumentException("Le nom réel de la ville ne peut pas être vide.");
        }
        $this->ville_nom_reel = $ville_nom_reel;
        return $this;
    }

    public function setVilleCodePostal(int $ville_code_postal): self
    {
        if ($ville_code_postal <= 0) {
            throw new \InvalidArgumentException("Le code postal de la ville doit être un entier positif.");
        }
        $this->ville_code_postal = $ville_code_postal;
        return $this;
    }

    public function setIdDepartement(int $id_departement): self
    {
        if ($id_departement <= 0) {
            throw new \InvalidArgumentException("L'ID du département doit être un entier positif.");
        }
        $this->id_departement = $id_departement;
        return $this;
    }
}
