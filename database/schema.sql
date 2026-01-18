 CREATE DATABASE Library_Management_System_Workshop ;
USE Library_Management_System_Workshop;

 CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE authors (
    author_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    biography TEXT,
    nationality VARCHAR(100),
    birth_date DATE,
    death_date DATE
);

 CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category_id INT,
    publication_year INT,
    description TEXT,
    cover_image VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL
);

CREATE TABLE book_author_pivot (
    isbn VARCHAR(20),
    author_id INT,
    PRIMARY KEY (isbn, author_id),
    FOREIGN KEY (isbn) REFERENCES books(isbn) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES authors(author_id) ON DELETE CASCADE
);
 
CREATE TABLE library_branches (
    branch_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    contact_info VARCHAR(100)
);

 CREATE TABLE book_copies (
    copy_id INT AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(20),
    branch_id INT,
    status ENUM('Available', 'Borrowed', 'Reserved', 'Maintenance') DEFAULT 'Available',
    added_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (isbn) REFERENCES books(isbn) ON DELETE CASCADE,
    FOREIGN KEY (branch_id) REFERENCES library_branches(branch_id) ON DELETE CASCADE
);
 CREATE TABLE members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    member_type ENUM('Student', 'Faculty') NOT NULL,
    registration_date DATE DEFAULT (CURRENT_DATE),
    expiry_date DATE NOT NULL,
    balance_fines DECIMAL(10, 2) DEFAULT 0.00 CHECK (balance_fines <= 100.00) , 
    status ENUM('Active', 'Suspended', 'Expired') DEFAULT 'Active'
);
 CREATE TABLE loans (
    loan_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    copy_id INT,
    borrow_date DATE DEFAULT (CURRENT_DATE),
    due_date DATE NOT NULL,
    return_date DATE NULL,
    is_renewed BOOLEAN DEFAULT FALSE, 
    fine_amount DECIMAL(10, 2) DEFAULT 0.00,
    FOREIGN KEY (member_id) REFERENCES members(member_id),
    FOREIGN KEY (copy_id) REFERENCES book_copies(copy_id)
);

 CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    isbn VARCHAR(20),
    branch_id INT,
    reservation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notification_sent_at TIMESTAMP NULL,  
    status ENUM('Pending', 'Notified', 'Completed', 'Cancelled', 'Expired') DEFAULT 'Pending',
    FOREIGN KEY (member_id) REFERENCES members(member_id),
    FOREIGN KEY (isbn) REFERENCES books(isbn),
    FOREIGN KEY (branch_id) REFERENCES library_branches(branch_id)
);