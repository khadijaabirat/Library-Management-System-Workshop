<?php
namespace src\Exceptions;

use Exception;

class LateFeeException extends Exception {
    public function __construct($message = "You have unpaid fines exceeding $10.00.", $code = 0) {
        parent::__construct($message, $code);
    }
}