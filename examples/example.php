<?php
require_once __DIR__ . '/../src/OrdersD96AReader.php';

$reader = new OrdersD96AReader();

if ($argc < 2) {
    echo "Usage: php example.php <file>\n";
    exit(1);
}

$segments = $reader->parseFile($argv[1]);
print_r($segments);
