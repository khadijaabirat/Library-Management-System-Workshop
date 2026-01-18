<?php
namespace src\Models;

abstract class Member {
    public string $memberId;
    public string $fullName;
    public string $email;
    public float $balanceFines;
    public string $status;

    public function __construct(string $id, string $name, string $email, float $fines = 0.0) {
        $this->memberId = $id;
        $this->fullName = $name;
        $this->email = $email;
        $this->balanceFines = $fines;
        $this->status = 'Active';
    }

     abstract public function getMaxBooks(): int;
    abstract public function getLoanDuration(): int; 
    abstract public function getDailyFineRate(): float;  
}