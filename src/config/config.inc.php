<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Sessie starten
session_start();

// Database connectie gegevens local
// $DATABASE_HOST = 'localhost';
// $DATABASE_USER = 'root';
// $DATABASE_PASS = '';
// $DATABASE_NAME = 'oefenexamen';

// Database connectie gegevens productie
$DATABASE_HOST = 'rdbms.strato.de';
$DATABASE_USER = 'U4431244';
$DATABASE_PASS = '@Luckie010';
$DATABASE_NAME = 'DB4431244';



// Proberen een connectie te leggen met de database
$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  } 
