<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $id_usuario = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Imagen = null;

    #[Vich\UploadableField(mapping: "playlist_images", fileNameProperty: "Imagen")]
    #[Assert\File(maxSize: "20M", mimeTypes: "image/*")]
    private ?File $ImagenFile = null;

    /**
     * @ORM\ManyToMany(targetEntity=Cancion::class)
     * @ORM\JoinTable(
     *     name="canciones_en_playlist",
     *     joinColumns={@ORM\JoinColumn(name="playlist_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="cancion_id", referencedColumnName="id")}
     * )
     */
    private ?Collection $canciones = null;

    public function __construct()
    {
        $this->canciones = new ArrayCollection(); // Inicializar como ArrayCollection
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;
        return $this;
    }

    public function getIdUsuario(): ?string
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(string $id_usuario): self
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->Imagen;
    }

    public function setImagen(string $Imagen): self
    {
        $this->Imagen = $Imagen;
        return $this;
    }

    public function getImagenFile(): ?File
    {
        return $this->ImagenFile;
    }

    public function setImagenFile(?File $ImagenFile): self
    {
        $this->ImagenFile = $ImagenFile;
        return $this;
    }

    /**
     * @return Collection|Cancion[]
     */
    public function getCanciones(): Collection
    {
        return $this->canciones ?: new ArrayCollection();
    }

    public function addCancion(Cancion $cancion): self
    {
        if (!$this->getCanciones()->contains($cancion)) {
            $this->canciones->add($cancion);
        }
        return $this;
    }

    public function removeCancion(Cancion $cancion): self
    {
        $this->getCanciones()->removeElement($cancion);
        return $this;
    }

    
}
