<?php 

require '../Controller/HomeController.php';

if ($_SESSION['loggedin']) {
    header('Location: ../../index.php');
    exit;
}

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT level FROM users WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result( $level);
$stmt->fetch();
$stmt->close();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../../index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="../../assets/css/home.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <style>
        .home-text {
            -webkit-text-decoration: #FBBF24 solid underline;
            text-decoration: #FBBF24 solid underline;
            -webkit-text-decoration-skip: ink;
            text-decoration-skip: ink;
        }
    </style>
</head>

<body class="loggedin">
    <div class="h-screen w-full flex overflow-hidden">
        <div class="flex-1 flex flex-col bg-gray-700 dark:bg-gray-700  overflow-y-auto">

            <!-- Dit is de navigatiebalk -->
            <header class="text-gray-100 bg-gray-900 body-font shadow w-full fixed">
                <div class="bg h-12 w-full"></div>
                <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
                    <nav class="lg:flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto hidden">
                        <a class="mr-5 hover:text-white cursor-pointer border-b border-transparent hover:border-yellow-400">Dashboard</a>
                        <a href="profile.php" class="hover:text-white cursor-pointer border-b border-transparent hover:border-yellow-400">Profile</a>
                        <a href="../controller/LogoutController.php" class="text-red-500 ml-4">
                            Logout
                        </a>
                    </nav>
                    <a href="#" class="home-text flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center lg:items-center lg:justify-center mb4 md:mb-0">
                        <span class="ml-3 text-xl">Hi, <?= $_SESSION['name'] ?> 👋</span>
                    </a>
                    <div class="lg:w-2/5 lg:justify-end hidden lg:inline-flex ml-5 lg:ml-0">
                        <a href="home/addTask.php" class="bg-yellow-400 text-gray-900 ml-4 py-2 px-3 rounded-lg">Add a new task</a>
                    </div>
                </div>
            </header>


        </div>
    </div>
</body>

</html>
