<?php

namespace App\Entity;

class Comment {
    private string $author;
    private string $content;
    private string $date;
    private int $likes;
    private Chara $chara;
    private ?int $id;

    public function __construct(
        string $content, 
        string $date, 
        int $likes, 
        string $author, 
        Chara $chara, 
        ?int $id = null) {

        $this->author = $author;
        $this->content = $content;
        $this->date = $date;
        $this->likes = $likes;
        $this->chara = $chara;
        $this->id = $id;
    }
    

    /**
     * Get the value of author
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Set the value of author
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of likes
     */
    public function getLikes(): int
    {
        return $this->likes;
    }

    /**
     * Set the value of likes
     */
    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get the value of chara
     */
    public function getChara(): Chara
    {
        return $this->chara;
    }

    /**
     * Set the value of chara
     */
    public function setChara(Chara $chara): self
    {
        $this->chara = $chara;

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