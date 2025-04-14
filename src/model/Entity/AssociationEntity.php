<?php

namespace App\model\Entity;

class AssociationEntity extends AbstractEntity {
    private int $id;
    private string $nomAssociation;
    private string $nomPresident;
    private string $adresseEmail;
    private string $numeroSiret;
    private string $telephone;
    private string $instagram;
    private string $facebook;
    private string $telegram;
    private string $siteWeb;
    private string $logoAssociation;
    private string $photoAssociation;

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setNomAssociation(string $nomAssociation): self {
        $this->nomAssociation = $nomAssociation;
        return $this;
    }

    public function getNomAssociation(): string {
        return $this->nomAssociation;
    }

    public function setNomPresident(string $nomPresident): self {
        $this->nomPresident = $nomPresident;
        return $this;
    }

    public function getNomPresident(): string {
        return $this->nomPresident;
    }

    public function setAdresseEmail(string $adresseEmail): self {
        $this->adresseEmail = $adresseEmail;
        return $this;
    }

    public function getAdresseEmail(): string {
        return $this->adresseEmail;
    }

    public function setNumeroSiret(string $numeroSiret): self {
        $this->numeroSiret = $numeroSiret;
        return $this;
    }

    public function getNumeroSiret(): string {
        return $this->numeroSiret;
    }

    public function setTelephone(string $telephone): self {
        $this->telephone = $telephone;
        return $this;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function setInstagram(string $instagram): self {
        $this->instagram = $instagram;
        return $this;
    }

    public function getInstagram(): string {
        return $this->instagram;
    }

    public function setFacebook(string $facebook): self {
        $this->facebook = $facebook;
        return $this;
    }

    public function getFacebook(): string {
        return $this->facebook;
    }

    public function setTelegram(string $telegram): self {
        $this->telegram = $telegram;
        return $this;
    }

    public function getTelegram(): string {
        return $this->telegram;
    }

    public function setSiteWeb(string $siteWeb): self {
        $this->siteWeb = $siteWeb;
        return $this;
    }

    public function getSiteWeb(): string {
        return $this->siteWeb;
    }

    public function setLogoAssociation(string $logoAssociation): self {
        $this->logoAssociation = $logoAssociation;
        return $this;
    }

    public function getLogoAssociation(): string {
        return $this->logoAssociation;
    }

    public function setPhotoAssociation(string $photoAssociation): self {
        $this->photoAssociation = $photoAssociation;
        return $this;
    }

    public function getPhotoAssociation(): string {
        return $this->photoAssociation;
    }
}