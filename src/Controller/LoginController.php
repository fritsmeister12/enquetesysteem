<?php
require '../config/config.inc.php';

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['studentnummer'], $_POST['wachtwoord'])) {
    // Could not get the data that should have been sent.
    exit('Please fill both the email and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, wachtwoord, geverifieerd FROM users WHERE studentnummer = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['studentnummer']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $verify);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['wachtwoord'], $password)) {
            // Verification success! User has loggedin!
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['studentnummer'];
            $_SESSION['id'] = $id;
            $_SESSION['verify'] = $verify;
            header('Location: ../View/dashboard.php');
        } else {
            // Incorrect password
            echo 'Incorrect email and/or password!';
        }
    } else {
        // Incorrect username
        echo 'Incorrect email and/or password!';
    }

    $stmt->close();
}
