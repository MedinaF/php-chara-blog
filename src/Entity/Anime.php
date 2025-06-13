<?php


namespace App\Entity;
use DateTime; 

class Anime {
    private ?int $id;
    private string $name;
    private string $genre;
    private ?DateTime $released;
    private ?string $poster;

    public function __construct(
        string $name,
        string $genre, 
        ?DateTime $released=null, 
        ?string $poster=null, 
        ?int $id =null
    ) {
        $this->name = $name;
        $this->genre = $genre;
        $this->released = $released;
        $this->poster = $poster;       
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
     * Get the value of released
     */
    public function getReleased(): ?DateTime
    {
        return $this->released;
    }

    /**
     * Set the value of released
     */
    public function setReleased(?DateTime $released): self
    {
        $this->released = $released;

        return $this;
    }

    /**
     * Get the value of poster
     */
    public function getPoster(): ?string
    {
        return $this->poster;
    }

    /**
     * Set the value of poster
     */
    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }
}

