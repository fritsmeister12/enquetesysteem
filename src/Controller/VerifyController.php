<?php
require '../config/config.inc.php';

// Escape user inputs voor veilighied tegen sql injection
$vkey = mysqli_real_escape_string($con, $_GET['vkey']);

// Proberen de sql in de database toe te voegen
$sql = "UPDATE users SET geverifieerd = '1' WHERE vkey = '$vkey'";
if (mysqli_query($con, $sql)) {
    header('Location: ../View/dashboard.php');
    exit;
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

// Close connection
mysqli_close($con);
