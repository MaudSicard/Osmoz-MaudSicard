<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("movies_read", "users_read")
     * @Groups("type_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("movies_read", "users_read")
     * @Groups("type_read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups("movies_read")
     * @Groups("type_read")
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("movies_read")
     * @Groups("type_read")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     * @Groups("movies_read")
     * @Groups("type_read")
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("movies_read")
     * @Groups("type_read")
     */
    private $support;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Gender::class, inversedBy="movies", cascade={"persist"})
     * @Groups("movies_read")
     * @Groups("type_read")
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="movies", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("movies_read")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="movies", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("movies_read")
     * @Groups("type_read")
     */
    private $user;

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

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(string $support): self
    {
        $this->support = $support;

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
}
