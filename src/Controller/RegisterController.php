<?php

// require '../config/config.inc.php';


// $to      = '83238@glr.nl';
// $subject = 'Verification';
// $message = "Verify\n\nhttps://matthewgroenendijk/oefenexamen/src/Controller/VerifyController.php?id='$id'";
// $headers = 'From: matthew@loopreizen.nl' . "\r\n" .
//     'Reply-To: matthew@loopreizen.nl' . "\r\n" .
//     'X-Mailer: PHP/' . phpversion();

// mail($to, $subject, $message, $headers);

require '../config/config.inc.php';

// Escape user inputs voor veilighied tegen sql injection
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

// Random verify code aanmaken
$vkey = md5(time().$studentnummer);

// Proberen de sql in de database toe te voegen
$sql = "INSERT INTO users (id, studentnummer, klas, voornaam, achternaam, adres, postcode, woonplaats, leeftijd, email, wachtwoord, level, geverifieerd, vkey) VALUES (NULL, '$studentnummer', '$klas', '$voornaam', '$achternaam', '$adres', '$postcode', '$woonplaats', '$leeftijd', '$email', '$wachtwoord', '0', '0', '$vkey')";
if (mysqli_query($con, $sql)) {
    $to      = $email;
    $subject = 'Verificatie';
    $message = "<a href='oefenexamen.matthewgroenendijk.com/src/Controller/VerifyController.php?vkey=".$vkey."'>Verifieer hier!</a>";
    $headers = 'From: verify@glr.nl' . "\r\n" .
        'Reply-To: verify@glr.nl' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    header('Location: ../View/verify.php');
    exit;
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

// Close connection
mysqli_close($con);
