<?php
namespace src\Models;

class Author {
    public int $id;
    public string $name;
    public string $biography;
    public string $nationality;
    public ?string $birthDate; 
    public ?string $deathDate;

    public function __construct(int $id, string $name, string $biography, string $nationality) {
        $this->id = $id;
        $this->name = $name;
        $this->biography = $biography;
        $this->nationality = $nationality;
    }
}