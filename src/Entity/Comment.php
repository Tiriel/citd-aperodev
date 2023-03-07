<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(min: 5)]
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\Email]
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[Assert\Length(min: 10)]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $postedAt = null;

    #[Assert\Type(type: Movie::class)]
    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Movie $movie = null;

    #[Assert\Range(min: 0, max: 6)]
    #[ORM\Column]
    private ?int $rating = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function getPostedAt(): ?\DateTimeImmutable
    {
        return $this->postedAt;
    }

    public function setPostedAt(\DateTimeImmutable $postedAt): self
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }
}
