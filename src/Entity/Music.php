<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MusicRepository::class)
 */
class Music
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("music_read", "users_read", "type_read")
     * @Groups("gender_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("music_read", "users_read", "type_read")
     * @Groups("gender_read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("music_read")
     * @Groups("type_read")
     * @Groups("gender_read")
     */
    private $artist;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups("music_read")
     * @Groups("type_read")
     * @Groups("gender_read")
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("music_read")
     * @Groups("type_read")
     * @Groups("gender_read")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     * @Groups("music_read")
     * @Groups("type_read")
     * @Groups("gender_read")
     */
    private $state;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("music_read")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Gender::class, inversedBy="music", cascade={"persist"})
     * @Groups("music_read")
     * @Groups("type_read")
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="music", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("music_read")
     * @Groups("gender_read")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="music", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("music_read")
     * @Groups("type_read")
     * @Groups("gender_read")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("music_read")
     * @Groups("type_read")
     * @Groups("gender_read")
     */
    private $support;

    public function __construct()
    {
        $this->gender = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Gender[]
     */
    public function getGender(): Collection
    {
        return $this->gender;
    }

    public function addGender(Gender $gender): self
    {
        if (!$this->gender->contains($gender)) {
            $this->gender[] = $gender;
        }

        return $this;
    }

    public function removeGender(Gender $gender): self
    {
        $this->gender->removeElement($gender);

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(string $support): self
    {
        $this->support = $support;

        return $this;
    }
}
