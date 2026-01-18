<?php
namespace src\Models;

class BookCopy {
    public int $id;
    public string $isbn;
    public int $branchId;
    public string $status;  
    public string $addedDate;

    public function __construct(int $id, string $isbn, int $branchId, string $status = 'Available') {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->branchId = $branchId;
        $this->status = $status;
        $this->addedDate = date('Y-m-d H:i:s');
    }
}