 INSERT INTO library_branches (name, address, contact_info) VALUES 
('Bibliothèque Centrale - Rabat', 'Avenue Mohammed V, Rabat', '0537112233'),
('Agence Maârif - Casablanca', 'Rue Al Fourat, Casablanca', '0522445566'),
('Agence Guéliz - Marrakech', 'Avenue Mohammed VI, Marrakech', '0524778899'),
('Agence Fès-Médina - Fès', 'Route d’Imouzzer, Fès', '0535112244'),
('Agence Malabata - Tanger', 'Quartier Malabata, Tanger', '0539667788');

 INSERT INTO categories (name, description) VALUES 
('Informatique', 'Livres sur le développement, IA et réseaux'),
('Histoire', 'Histoire mondiale et biographies'),
('Littérature', 'Romans classiques et contemporains');

 INSERT INTO authors (name, biography, nationality) VALUES 
('Robert C. Martin', 'Expert en génie logiciel, auteur de Clean Code.', 'Américain'),
('Frantz Fanon', 'Psychiatre et révolutionnaire, auteur des Damnés de la Terre.', 'Martiniquais'),
('Albert Camus', 'Écrivain et philosophe, Prix Nobel de littérature.', 'Français');

 INSERT INTO books (isbn, title, category_id, publication_year, description) VALUES 
('978-0132350884', 'Clean Code', 1, 2008, 'Manuel de l’artisan logiciel agile'),
('978-2020228461', 'L’Étranger', 3, 1942, 'Roman philosophique majeur du XXe siècle');

 INSERT INTO book_copies (isbn, branch_id, status) VALUES 
('978-0132350884', 1, 'Available'),  
('978-0132350884', 2, 'Available'),  
('978-2020228461', 1, 'Borrowed'),   
('978-2020228461', 3, 'Available');  

 INSERT INTO members (full_name, email, member_type, expiry_date, balance_fines) VALUES 
('Yassine Mansouri', 'yassine@student.ma', 'Student', '2026-12-31', 0.00),     
('Hind Bennani', 'hind@student.ma', 'Student', '2026-12-31', 15.50),        
('Prof. Amine Alaoui', 'alaoui@faculty.ma', 'Faculty', '2027-01-01', 0.00);  

 INSERT INTO loans (member_id, copy_id, borrow_date, due_date) VALUES 
(1, 1, '2026-01-10', '2026-01-24');  