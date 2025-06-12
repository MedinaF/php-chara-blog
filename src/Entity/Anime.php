<?php


namespace App\Entity;

class Anime {
    private ?int $id;
    private string $name;
    private string $genre;
    private int $release;
    private ?string $image;

    public function __construct(
        string $name,
        string $genre, 
        int $release, 
        ?string $image=null, 
        ?int $id =null
    ) {
        $this->name = $name;
        $this->genre = $genre;
        $this->release = $release;
        $this->image = $image;       
        $this->id = $id;
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

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of genre
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     */
    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of release
     */
    public function getRelease(): int
    {
        return $this->release;
    }

    /**
     * Set the value of release
     */
    public function setRelease(int $release): self
    {
        $this->release = $release;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}

