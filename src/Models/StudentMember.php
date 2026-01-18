<?php
namespace src\Models;

class StudentMember extends Member {
    public function getMaxBooks(): int {
         return 3;
          }
    public function getLoanDuration(): int { 
        return 14;
         }
    public function getDailyFineRate(): float {
         return 0.50; 
         }
}