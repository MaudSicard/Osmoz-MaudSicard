<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MailRepository::class)
 */
class Mail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
<<<<<<< HEAD
     * @Groups("users_read")
     * @Groups("mails_read")
=======
     * @Groups("users_read", "mails_read")
>>>>>>> keyword
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
<<<<<<< HEAD
     * @Groups("users_read")
     * @Groups("mails_read")
=======
     * @Groups("users_read", "mails_read")
>>>>>>> keyword
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="mail")
     * @Groups("mails_read")
     */
    private $users;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("users_read", "mails_read")
     */
    private $sender_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("users_read", "mails_read")
     */
    private $recipient_id;

    public function __construct()
    {
        $this->createdAt = new \datetime();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addMail($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeMail($this);
        }

        return $this;
    }


    public function getSenderId(): ?int
    {
        return $this->sender_id;
    }

    public function setSenderId(?int $sender_id): self
    {
        $this->sender_id = $sender_id;

        return $this;
    }

    public function getRecipientId(): ?int
    {
        return $this->recipient_id;
    }

    public function setRecipientId(?int $recipient_id): self
    {
        $this->recipient_id = $recipient_id;

        return $this;
    }

}