<?php

namespace App\Model\Entity;

class UserEntity extends AbstractEntity
{
    private int $Id_user;
    private string $user_nom;
    private string $user_prenom;
    private string $user_email;
    private string $user_telephone;
    private string $user_naissance;
    private string $user_arriver_france;
    private string $user_langue_francaise;
    private string $user_experience;
    private string $user_niveau_etude;
    private string $user_dernier_poste_ukraine;
    private string $user_dernier_poste_france;
    private string $user_ville_ukraine;
    private string $user_pseudonyme;
    private string $user_mp;
    private ?int $id_villeFR = null;
    private ?int $idTypeUser = null;

    public function setIdUser(int $id): self
    {
        $this->Id_user = $id;
        return $this;
    }

    public function getIdUser(): int
    {
        return $this->Id_user;
    }

    public function getIdVilleFR(): int
    {
        if ($this->id_villeFR === null) {
            return 0; // Retourne une valeur par défaut si $id_villeFR est null
        }
        return $this->id_villeFR;
    }

    public function setIdVilleFR(int $idVilleFR): self
    {
        $this->id_villeFR = $idVilleFR;
        return $this;
    }

    public function getUserNom(): string
    {
        return $this->user_nom;
    }

    public function setUserNom(string $user_nom): self
    {
        $this->user_nom = $user_nom;
        return $this;
    }

    public function getUserPrenom(): string
    {
        return $this->user_prenom;
    }

    public function setUserPrenom(string $user_prenom): self
    {
        $this->user_prenom = $user_prenom;
        return $this;
    }

    public function getUserEmail(): string
    {
        return $this->user_email;
    }

    public function setUserEmail(string $user_email): self
    {
        $this->user_email = $user_email;
        return $this;
    }

    public function getUserTelephone(): string
    {
        return $this->user_telephone;
    }

    public function setUserTelephone(string $user_telephone): self
    {
        $this->user_telephone = $user_telephone;
        return $this;
    }

    public function getUserNaissance(): string
    {
        return $this->user_naissance;
    }

    public function setUserNaissance(string $user_naissance): self
    {
        $this->user_naissance = $user_naissance;
        return $this;
    }

    public function getUserArriverFrance(): string
    {
        return $this->user_arriver_france;
    }

    public function setUserArriverFrance(string $user_arriver_france): self
    {
        $this->user_arriver_france = $user_arriver_france;
        return $this;
    }

    public function getUserLangueFrancaise(): string
    {
        return $this->user_langue_francaise;
    }

    public function setUserLangueFrancaise(string $user_langue_francaise): self
    {
        $this->user_langue_francaise = $user_langue_francaise;
        return $this;
    }

    public function getUserExperience(): string
    {
        return $this->user_experience;
    }

    public function setUserExperience(string $user_experience): self
    {
        $this->user_experience = $user_experience;
        return $this;
    }

    public function getUserNiveauEtude(): string
    {
        return $this->user_niveau_etude;
    }

    public function setUserNiveauEtude(string $user_niveau_etude): self
    {
        $this->user_niveau_etude = $user_niveau_etude;
        return $this;
    }

    public function getUserDernierPosteUkraine(): string
    {
        return $this->user_dernier_poste_ukraine;
    }

    public function setUserDernierPosteUkraine(string $user_dernier_poste_ukraine): self
    {
        $this->user_dernier_poste_ukraine = $user_dernier_poste_ukraine;
        return $this;
    }

    public function getUserDernierPosteFrance(): string
    {
        return $this->user_dernier_poste_france;
    }

    public function setUserDernierPosteFrance(string $user_dernier_poste_france): self
    {
        $this->user_dernier_poste_france = $user_dernier_poste_france;
        return $this;
    }

    public function getUserVilleUkraine(): string
    {
        return $this->user_ville_ukraine;
    }

    public function setUserVilleUkraine(string $user_ville_ukraine): self
    {
        $this->user_ville_ukraine = $user_ville_ukraine;
        return $this;
    }

    public function getUserPseudonyme(): string
    {
        return $this->user_pseudonyme;
    }

    public function setUserPseudonyme(string $user_pseudonyme): self
    {
        $this->user_pseudonyme = $user_pseudonyme;
        return $this;
    }

    public function getUserMp(): string
    {
        return $this->user_mp;
    }

    public function setUserMp(string $user_mp): self
    {
        $this->user_mp = $user_mp;
        return $this;
    }

    public function getIdTypeUser(): ?int
    {
        return $this->idTypeUser;
    }

    public function setIdTypeUser(?int $idTypeUser): self
    {
        $this->idTypeUser = $idTypeUser;
        return $this;
    }
}
