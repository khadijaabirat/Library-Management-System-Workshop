<?php
namespace src\Models;

class Book {
    public string $isbn;
    public string $title;
    public int $publicationYear;
    public array $authors = []; 

    public function __construct(string $isbn, string $title, int $year) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->publicationYear = $year;
    }
}