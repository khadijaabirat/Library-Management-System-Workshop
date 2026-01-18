<?php
namespace src\Models;

class LibraryBranch {
    public int $id;
    public string $name;
    public string $address;
    public string $contactInfo;

    public function __construct(int $id, string $name, string $address) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
    }
}