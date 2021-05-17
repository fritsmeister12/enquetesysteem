<?php
require '../config/config.inc.php';

// Escape user inputs voor veilighied tegen sql injection
$id = mysqli_real_escape_string($con, $_POST['id']);
$studentnummer = mysqli_real_escape_string($con, $_POST['studentnummer']);
$klas = mysqli_real_escape_string($con, $_POST['klas']);
$voornaam = mysqli_real_escape_string($con, $_POST['voornaam']);
$achternaam = mysqli_real_escape_string($con, $_POST['achternaam']);
$adres = mysqli_real_escape_string($con, $_POST['adres']);
$postcode = mysqli_real_escape_string($con, $_POST['postcode']);
$woonplaats = mysqli_real_escape_string($con, $_POST['woonplaats']);
$leeftijd = mysqli_real_escape_string($con, $_POST['leeftijd']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$wachtwoord = mysqli_real_escape_string($con, $_POST['wachtwoord']);

$wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

// Proberen de sql in de database toe te voegen
$sql = "UPDATE users SET studentnummer = '$studentnummer', klas = '$klas', voornaam = '$voornaam', achternaam = '$achternaam', adres = '$adres', postcode = '$postcode', woonplaats = '$woonplaats', leeftijd = '$leeftijd', email = '$email', wachtwoord = '$wachtwoord' WHERE id = '$id'";
if (mysqli_query($con, $sql)) {
    header('Location: ../View/profile.php');
    exit;
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

// Close connection
mysqli_close($con);
