<?php


namespace App\Entity;

class Chara {
    private string $firstname;
    private ?string $lastname;
    private int $age;
    private Anime $anime;
    private ?string $picture;
    private ?int $id;

    public function __construct(
        string $firstname,
        ?string  $lastname, 
        int $age, 
        Anime $anime,
        ?string $picture = null,
        ?int $id = null
    ) {
        if ($age < 0) {
        throw new \InvalidArgumentException("L'âge doit être supérieur ou égal à zéro.");
        }
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
        $this->anime = $anime;
        $this->picture = $picture;
        $this->id = $id;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname(): ?string 
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     */
    public function setLastname(?string  $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * Set the value of age
     */
    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of anime
     */
    public function getAnime(): Anime
    {
        return $this->anime;
    }

    /**
     * Set the value of anime
     */
    public function setAnime(Anime $anime): self
    {
        $this->anime = $anime;

        return $this;
    }

    /**
     * Get the value of picture
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     */
    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
}