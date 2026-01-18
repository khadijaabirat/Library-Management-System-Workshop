<?php
namespace src\Repositories;

use PDO;

class BookRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

     public function searchBooks(string $term): array
    {
        $sql = "
            SELECT 
                b.*,
                c.name AS category_name,
                GROUP_CONCAT(a.name) AS authors
            FROM books b
            JOIN categories c ON b.category_id = c.category_id
            JOIN book_author_pivot ba ON b.isbn = ba.isbn
            JOIN authors a ON ba.author_id = a.author_id
            WHERE b.title LIKE :term
               OR a.name LIKE :term
               OR c.name LIKE :term
            GROUP BY b.isbn
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':term' => '%' . $term . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public function getAvailableCopiesCount(string $isbn, int $branchId): int
    {
        $sql = "
            SELECT COUNT(*)
            FROM book_copies
            WHERE isbn = :isbn
              AND branch_id = :branch_id
              AND status = 'Available'
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':isbn'      => $isbn,
            ':branch_id' => $branchId
        ]);

        return (int) $stmt->fetchColumn();
    }
}
