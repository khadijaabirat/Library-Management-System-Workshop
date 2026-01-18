<?php
namespace src\Models;

class FacultyMember extends Member {
    public function getMaxBooks(): int {
         return 10;
          }
    public function getLoanDuration(): int { 
        return 30; 
        }
    public function getDailyFineRate(): float {
         return 0.25;
          }
}