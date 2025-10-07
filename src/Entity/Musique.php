<?php

namespace App\Entity;

use App\Repository\MusiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusiqueRepository::class)]
class Musique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, artist>
     */
    #[ORM\ManyToMany(targetEntity: artist::class, inversedBy: 'musiques')]
    private Collection $artist;

    #[ORM\Column(length: 255)]
    private ?string $album = null;

    public function __construct()
    {
        $this->artist = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, artist>
     */
    public function getArtist(): Collection
    {
        return $this->artist;
    }

    public function addArtist(artist $artist): static
    {
        if (!$this->artist->contains($artist)) {
            $this->artist->add($artist);
        }

        return $this;
    }

    public function removeArtist(artist $artist): static
    {
        $this->artist->removeElement($artist);

        return $this;
    }

    public function getAlbum(): ?string
    {
        return $this->album;
    }

    public function setAlbum(string $album): static
    {
        $this->album = $album;

        return $this;
    }
}
