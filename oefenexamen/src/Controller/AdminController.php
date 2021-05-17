<?php

use src\Model\HomeData;

require '../config/config.inc.php';
require '../Model/HomeData.php';

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT voornaam, achternaam, geverifieerd, level FROM users WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($voornaam, $achternaam, $verify, $level);
$stmt->fetch();
$stmt->close();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../../index.php');
    exit;
}

if ($verify != 1){
    header('Location: ../../login.php');
    exit;
}

if($level != 1){
    header('Location: ../View/dashboard.php');
    exit;
} 