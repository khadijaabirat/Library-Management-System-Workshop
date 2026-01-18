<?php
namespace src\Models;

class BorrowRecord {
    public int $recordId;
    public string $memberId;
    public int $copyId;
    public string $borrowDate;
    public string $dueDate;
    public ?string $returnDate;
    public bool $isRenewed = false;

    public function __construct($memberId, $copyId, $dueDate) {
        $this->memberId = $memberId;
        $this->copyId = $copyId;
        $this->borrowDate = date('Y-m-d');
        $this->dueDate = $dueDate;
        $this->returnDate = null;
    }
}