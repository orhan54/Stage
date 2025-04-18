<?php

namespace App\model\Entity;

class AssociationEntity extends AbstractEntity
{
    private int $id;
    private string $nomAssociation;
    private string $nomPresident;
    private string $telephone;
    private string $adresseEmail;
    private string $dateInscription;
    private string $facebook;
    private string $instagram;
    private string $telegram;
    private string $descriptionFR;
    private string $associationSiret;
    private string $associationSiteWeb;
    private string $associationLogo;
    private string $associationPhoto;
    private string $associationMp;
    private int $idVilleFR;

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAssociationNom(): string
    {
        return $this->nomAssociation;
    }

    public function setAssociationNom(string $nomAssociation): self
    {
        $this->nomAssociation = $nomAssociation;
        return $this;
    }

    public function getAssociationPresident(): string
    {
        return $this->nomPresident;
    }

    public function setAssociationPresident(string $nomPresident): self
    {
        $this->nomPresident = $nomPresident;
        return $this;
    }

    public function getAssociationTelephone(): string
    {
        return $this->telephone;
    }

    public function setAssociationTelephone(string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getAssociationEmail(): string
    {
        return $this->adresseEmail;
    }

    public function setAssociationEmail(string $adresseEmail): self
    {
        $this->adresseEmail = $adresseEmail;
        return $this;
    }

    public function getAssociationDate(): string
    {
        return $this->dateInscription;
    }

    public function setAssociationDate(string $dateInscription): self
    {
        $this->dateInscription = $dateInscription;
        return $this;
    }

    public function getAssociationFacebook(): string
    {
        return $this->facebook;
    }

    public function setAssociationFacebook(string $facebook): self
    {
        $this->facebook = $facebook;
        return $this;
    }

    public function getAssociationInstagram(): string
    {
        return $this->instagram;
    }

    public function setAssociationInstagram(string $instagram): self
    {
        $this->instagram = $instagram;
        return $this;
    }

    public function getAssociationTelegram(): string
    {
        return $this->telegram;
    }

    public function setAssociationTelegram(string $telegram): self
    {
        $this->telegram = $telegram;
        return $this;
    }

    public function getAssociationDescriptionFR(): string
    {
        return $this->descriptionFR;
    }

    public function setAssociationDescriptionFR(string $descriptionFR): self
    {
        $this->descriptionFR = $descriptionFR;
        return $this;
    }

    public function getAssociationSiret(): string
    {
        return $this->associationSiret;
    }

    public function setAssociationSiret(string $associationSiret): self
    {
        $this->associationSiret = $associationSiret;
        return $this;
    }

    public function getAssociationSiteWeb(): string
    {
        return $this->associationSiteWeb;
    }

    public function setAssociationSiteWeb(string $associationSiteWeb): self
    {
        $this->associationSiteWeb = $associationSiteWeb;
        return $this;
    }

    public function getAssociationLogo(): string
    {
        return $this->associationLogo;
    }

    public function setAssociationLogo(string $associationLogo): self
    {
        $this->associationLogo = $associationLogo;
        return $this;
    }

    public function getAssociationPhoto(): string
    {
        return $this->associationPhoto;
    }

    public function setAssociationPhoto(string $associationPhoto): self
    {
        $this->associationPhoto = $associationPhoto;
        return $this;
    }

    public function getAssociationMp(): string
    {
        return $this->associationMp;
    }

    public function setAssociationMp(string $associationMp): self
    {
        $this->associationMp = $associationMp;
        return $this;
    }

    public function getIdVilleFR(): int
    {
        return $this->idVilleFR;
    }

    public function setIdVilleFR(int $idVilleFR): self
    {
        $this->idVilleFR = $idVilleFR;
        return $this;
    }

}
