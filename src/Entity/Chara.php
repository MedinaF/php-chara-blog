<?php


namespace App\Entity;

class Chara {
    private ?int $id;
    private string $firstname;
    private string $lastname;
    private int $age;

    public function __construct(
        string $firstname,
        string $lastname, 
        int $age, 
        ?int $id =null
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
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
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of name
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getlastname(): string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     */
    public function setlastname(string $lastname): self
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
}