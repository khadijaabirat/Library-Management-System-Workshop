<?php
namespace App\Services;

use App\Repositories\BorrowRepository;
use App\Repositories\MemberRepository;
use App\Exceptions\LateFeeException;

class LibraryService {
    private $memberRepo;
    private $borrowRepo;

    public function __construct($memberRepo, $borrowRepo) {
        $this->memberRepo = $memberRepo;
        $this->borrowRepo = $borrowRepo;
    }

    public function borrowBook($memberId, $copyId) {
         $member = $this->memberRepo->findById($memberId);
        if ($member->balance_fines > 10.00) {
            throw new LateFeeException();
        }
 
        }
}