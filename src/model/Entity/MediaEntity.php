<?php
namespace App\Model\Entity;

class MediaEntity extends AbstractEntity
{
    private ?int $Id_media = null;
    private string $media_chemin;
    private int $Id_type_media;
    private ?int $Id_evenement = null; // Initialiser à null
    private ?int $Id_hebergement = null; // Initialiser à null

    /**
     * Récupère l'ID du média
     * @return int|null
     */
    public function getIdMedia(): ?int
    {
        return $this->Id_media;
    }

    /**
     * Définit l'ID du média
     * @param int $Id_media
     * @return self
     */
    public function setIdMedia(int $Id_media): self
    {
        $this->Id_media = $Id_media;
        return $this;
    }

    /**
     * Récupère le chemin du média
     * @return string
     */
    public function getMediaChemin(): string
    {
        return $this->media_chemin;
    }

    /**
     * Définit le chemin du média
     * @param string $media_chemin
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setMediaChemin(string $media_chemin): self
    {
        if (empty($media_chemin)) {
            throw new \InvalidArgumentException("Le chemin du média ne peut pas être vide.");
        }
        $this->media_chemin = $media_chemin;
        return $this;
    }

    /**
     * Récupère l'ID du type de média
     * @return int
     */
    public function getIdTypeMedia(): int
    {
        return $this->Id_type_media;
    }

    /**
     * Définit l'ID du type de média
     * @param int $Id_type_media
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setIdTypeMedia(int $Id_type_media): self
    {
        if ($Id_type_media <= 0) {
            throw new \InvalidArgumentException("L'ID du type de média doit être un entier positif.");
        }
        $this->Id_type_media = $Id_type_media;
        return $this;
    }

    /**
     * Récupère l'ID de l'événement
     * @return int|null
     */
    public function getIdEvenement(): ?int
    {
        return $this->Id_evenement;
    }

    /**
     * Définit l'ID de l'événement
     * @param int|null $Id_evenement
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setIdEvenement(?int $Id_evenement): self
    {
        if ($Id_evenement !== null && $Id_evenement <= 0) {
            throw new \InvalidArgumentException("L'ID de l'événement doit être un entier positif.");
        }
        $this->Id_evenement = $Id_evenement;
        return $this;
    }

    /**
     * Récupère l'ID de l'hébergement
     * @return int|null
     */
    public function getIdHebergement(): ?int
    {
        return $this->Id_hebergement;
    }

    /**
     * Définit l'ID de l'hébergement
     * @param int|null $Id_hebergement
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setIdHebergement(?int $Id_hebergement): self
    {
        if ($Id_hebergement !== null && $Id_hebergement <= 0) {
            throw new \InvalidArgumentException("L'ID de l'hébergement doit être un entier positif.");
        }
        $this->Id_hebergement = $Id_hebergement;
        return $this;
    }
}