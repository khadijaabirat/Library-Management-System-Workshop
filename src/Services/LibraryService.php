<?php
namespace src\Services;

use src\Repositories\BookRepository;
use src\Repositories\MemberRepository;
use src\Repositories\BorrowRepository;
use src\Exceptions\LateFeeException;
use src\Exceptions\BookUnavailableException;
use src\Exceptions\MemberLimitExceededException;

class LibraryService {
    private $bookRepo;
    private $memberRepo;
    private $borrowRepo;

    public function __construct($bookRepo, $memberRepo, $borrowRepo) {
        $this->bookRepo = $bookRepo;
        $this->memberRepo = $memberRepo;
        $this->borrowRepo = $borrowRepo;
    }
 
    public function borrowBook(int $memberId, string $isbn, int $branchId) {
         $member = $this->memberRepo->findById($memberId);
        if (!$member) throw new \Exception("Member not found.");

         if ($member->balanceFines > 10.00) {
            throw new LateFeeException("Fines exceed $10.00 limit. Please pay before borrowing.");
        }

         $activeLoansCount = $this->borrowRepo->countActiveLoans($memberId);
        if ($activeLoansCount >= $member->getMaxBooks()) {
            throw new MemberLimitExceededException("You have reached your limit of " . $member->getMaxBooks() . " books.");
        }

         $availableCopy = $this->bookRepo->findFirstAvailableCopy($isbn, $branchId);
        if (!$availableCopy) {
            throw new BookUnavailableException("No copies available for this book in this branch.");
        }

         $duration = $member->getLoanDuration();
        $dueDate = date('Y-m-d', strtotime("+$duration days"));

         return $this->borrowRepo->createLoan($memberId, $availableCopy['copy_id'], $dueDate);
    }
 
    public function returnBook(int $loanId) {
        $loan = $this->borrowRepo->findLoanById($loanId);
        $member = $this->memberRepo->findById($loan['member_id']);
        
        $today = date_create(date('Y-m-d'));
        $dueDate = date_create($loan['due_date']);
        
        if ($today > $dueDate) {
            $diff = date_diff($today, $dueDate);
            $daysLate = $diff->format("%a");
            $fineAmount = $daysLate * $member->getDailyFineRate();
            
            $this->memberRepo->updateFines($member->memberId, $fineAmount);
        }

        return $this->borrowRepo->markAsReturned($loanId, $loan['copy_id']);
    }
}