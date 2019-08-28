<?php

require_once __DIR__ . '/SQLStrategyInterface.php';
require_once __DIR__ . '/MySQLConn.php';
require_once __DIR__ . '/DatabaseManager.php';

$c = new DatabaseManager(
    new MySQLConn(
        'localhost',
        'root',
        'pswd1234',
        'classicmodels',
        [
            PDO::ATTR_EMULATE_PREPARES   => false,                  // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC        // make the default fetch be an associative array
        ]
    )
);

print_r(
    $c->all(
        "SELECT * FROM customers WHERE customerNumber=:customerNumber",
        [
            ':customerNumber' => 103
        ]
    )
);
