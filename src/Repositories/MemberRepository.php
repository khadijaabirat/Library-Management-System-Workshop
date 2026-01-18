<?php
namespace src\Repositories;

use src\Models\StudentMember;
use src\Models\FacultyMember;
use src\Models\Member;
use PDO;

class MemberRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findById(int $id): ?Member {
        $query = "SELECT * FROM members WHERE member_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

         if ($row['member_type'] === 'Student') {
            return new StudentMember($row['member_id'], $row['full_name'], $row['email'], $row['balance_fines']);
        } else {
            return new FacultyMember($row['member_id'], $row['full_name'], $row['email'], $row['balance_fines']);
        }
    }
}