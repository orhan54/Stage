<?php

namespace App\Model\Entity;

class AssociationEntity extends AbstractEntity
{
    private int $Id_association;
    private string $association_nom;
    private string $association_president;
    private string $association_telephone;
    private string $association_email;
    private string $association_date;
    private string $association_facebook;
    private string $association_instagram;
    private string $association_telegram;
    private string $association_description_FR;
    private string $association_siret;
    private string $association_site_web;
    private string $association_logo;
    private string $association_photo;
    private ?string $association_mp = null;
    private int $id_villeFR;

    
    public function setIdAssociation(int $id): self
    {
        $this->Id_association = $id;
        return $this;
    }

    public function getIdAssociation(): int
    {
        return $this->Id_association;
    }

    public function getAssociationNom(): string
    {
        return $this->association_nom;
    }

    public function setAssociationNom(string $association_nom): self
    {
        $this->association_nom = $association_nom;
        return $this;
    }

    public function getAssociationPresident(): string
    {
        return $this->association_president;
    }

    public function setAssociationPresident(string $association_president): self
    {
        $this->association_president = $association_president;
        return $this;
    }

    public function getAssociationTelephone(): string
    {
        return $this->association_telephone;
    }

    public function setAssociationTelephone(string $association_telephone): self
    {
        $this->association_telephone = $association_telephone;
        return $this;
    }

    public function getAssociationEmail(): string
    {
        return $this->association_email;
    }

    public function setAssociationEmail(string $association_email): self
    {
        $this->association_email = $association_email;
        return $this;
    }

    public function getAssociationDate(): string
    {
        return $this->association_date;
    }

    public function setAssociationDate(string $association_date): self
    {
        $this->association_date = $association_date;
        return $this;
    }

    public function getAssociationFacebook(): string
    {
        return $this->association_facebook;
    }

    public function setAssociationFacebook(string $association_facebook): self
    {
        $this->association_facebook = $association_facebook;
        return $this;
    }

    public function getAssociationInstagram(): string
    {
        return $this->association_instagram;
    }

    public function setAssociationInstagram(string $association_instagram): self
    {
        $this->association_instagram = $association_instagram;
        return $this;
    }

    public function getAssociationTelegram(): string
    {
        return $this->association_telegram;
    }

    public function setAssociationTelegram(string $association_telegram): self
    {
        $this->association_telegram = $association_telegram;
        return $this;
    }

    public function getAssociationDescriptionFR(): string
    {
        return $this->association_description_FR;
    }

    public function setAssociationDescriptionFR(string $association_description_FR): self
    {
        $this->association_description_FR = $association_description_FR;
        return $this;
    }

    public function getAssociationSiret(): string
    {
        return $this->association_siret;
    }

    public function setAssociationSiret(string $association_siret): self
    {
        $this->association_siret = $association_siret;
        return $this;
    }

    public function getAssociationSiteWeb(): string
    {
        return $this->association_site_web;
    }

    public function setAssociationSiteWeb(string $association_site_web): self
    {
        $this->association_site_web = $association_site_web;
        return $this;
    }

    public function getAssociationLogo(): string
    {
        return $this->association_logo;
    }

    public function setAssociationLogo(string $association_logo): self
    {
        $this->association_logo = $association_logo;
        return $this;
    }

    public function getAssociationPhoto(): string
    {
        return $this->association_photo;
    }

    public function setAssociationPhoto(string $association_photo): self
    {
        $this->association_photo = $association_photo;
        return $this;
    }

    public function getAssociationMp(): ?string
    {
        return $this->association_mp;
    }

    public function setAssociationMp(?string $association_mp): self
    {
        $this->association_mp = $association_mp;
        return $this;
    }

    public function getIdVilleFR(): int
    {
        return $this->id_villeFR;
    }

    public function setIdVilleFR(int $id_villeFR): self
    {
        $this->id_villeFR = $id_villeFR;
        return $this;
    }
    
}
