<?php
require_once __DIR__ . '/../src/Repositories/DatabaseConnection.php';
require_once __DIR__ . '/../src/Models/Member.php';
require_once __DIR__ . '/../src/Models/StudentMember.php';
require_once __DIR__ . '/../src/Models/FacultyMember.php';
require_once __DIR__ . '/../src/Exceptions/LateFeeException.php';
require_once __DIR__ . '/../src/Services/LibraryService.php';

use src\Repositories\DatabaseConnection;
use src\Services\LibraryService;
use src\Models\StudentMember;
use src\Exceptions\LateFeeException;

 $db = DatabaseConnection::getInstance();
 

 $bookRepo = new \src\Repositories\BookRepository($db);
$memberRepo = new \src\Repositories\MemberRepository($db);
$borrowRepo = new \src\Repositories\BorrowRepository($db);

$libraryService = new LibraryService($bookRepo, $memberRepo, $borrowRepo);

echo "Testing database <br>";

 try {
    echo "Scenario 1: Student with $12 fine trying to borrow... <br>";
    $libraryService->borrowBook(1, "978-0132350884", 1); 
} catch (LateFeeException $e) {
    echo " Caught expected error: " . $e->getMessage() . "<br>";
}

 try {
    echo "Scenario 2: Student trying to borrow 4th book... <br>";
     $libraryService->borrowBook(2, "978-0132350884", 1);
} catch (\src\Exceptions\MemberLimitExceededException $e) {
    echo " Caught expected error: " . $e->getMessage() . "<br>";
}

 echo "Scenario 3: Calculating fine for a student (14 days limit)... <br>";
 