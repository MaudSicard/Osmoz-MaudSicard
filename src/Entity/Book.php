<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("book_read", "users_read", "type_read", "gender_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("book_read", "users_read", "type_read", "gender_read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("book_read", "users_read", "type_read", "gender_read")
     */
    private $author;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("book_read", "users_read", "type_read", "gender_read")

     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("book_read", "users_read", "type_read", "gender_read")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     * @Groups("book_read", "users_read", "type_read", "gender_read")
     */
    private $state;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("book_read")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("book_read")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Gender::class, inversedBy="books", cascade={"persist"})
     * @Groups("book_read", "type_read", "users_read")
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="books", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("book_read", "gender_read", "users_read")

     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="books", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("book_read", "type_read", "gender_read")

     */
    private $user;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups("book_read")
     */
    private $slug;

    public function __construct()
    {
        $this->createdAt = new \datetime();
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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}