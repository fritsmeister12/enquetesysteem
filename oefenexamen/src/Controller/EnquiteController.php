<?php
require '../config/config.inc.php';

// Escape user inputs voor veilighied tegen sql injection
$afstand_kilometers = mysqli_real_escape_string($con, $_POST['afstand_kilometers']);
$afstand_tijd = mysqli_real_escape_string($con, $_POST['afstand_tijd']);
$vervoer = $_POST['vervoer'];
$begintijd = mysqli_real_escape_string($con, $_POST['begintijd']);
$eindtijd = mysqli_real_escape_string($con, $_POST['eindtijd']);
$opmerkingen = mysqli_real_escape_string($con, $_POST['opmerkingen']);
$studentnummer = mysqli_real_escape_string($con, $_POST['studentnummer']);

$verv = "";

foreach($vervoer as $verv1) {
    $verv .= $verv1.", ";
}

// Proberen de sql in de database toe te voegen
$sql = "INSERT INTO enquites (id, afstand_kilometers, afstand_tijd, vervoer, begintijd, eindtijd, opmerkingen, studentnummer) VALUES (NULL, '$afstand_kilometers', '$afstand_tijd', '$verv', '$begintijd', '$eindtijd', '$opmerkingen', '$studentnummer')";
if (mysqli_query($con, $sql)) {
    header('Location: ../View/profile.php');
    exit;
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

// Close connection
mysqli_close($con);
