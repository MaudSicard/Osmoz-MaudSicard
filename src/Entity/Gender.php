<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GenderRepository::class)
 */
class Gender
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("book_read")
     * @Groups("music_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("book_read")
     * @Groups("music_read")
     * @Groups("movies_read")
     */
    private $name;

    /**
     * @ORM\Column(type="json")
     */
    private $media = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Movie::class, mappedBy="gender")
     */
    private $movies;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, mappedBy="gender", cascade={"persist"})
     */
    private $books;

    /**
     * @ORM\ManyToMany(targetEntity=Music::class, mappedBy="gender", cascade={"persist"})
     */
    private $music;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
        $this->books = new ArrayCollection();
        $this->music = new ArrayCollection();
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

    public function getMedia(): ?array
    {
        return $this->media;
    }

    public function setMedia(array $media): self
    {
        $this->media = $media;

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
     * @return Collection|Movie[]
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->addGender($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            $movie->removeGender($this);
        }

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addGender($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            $book->removeGender($this);
        }

        return $this;
    }

    /**
     * @return Collection|Music[]
     */
    public function getMusic(): Collection
    {
        return $this->music;
    }

    public function addMusic(Music $music): self
    {
        if (!$this->music->contains($music)) {
            $this->music[] = $music;
            $music->addGender($this);
        }

        return $this;
    }

    public function removeMusic(Music $music): self
    {
        if ($this->music->removeElement($music)) {
            $music->removeGender($this);
        }

        return $this;
    }
}
