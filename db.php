<?php

$dsn = "mysql:host=127.0.0.1;dbname=phplogin";
$DB_USER = "root";
$DB_PASS = "";
try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

