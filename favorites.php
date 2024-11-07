<?php
session_start();

if (empty($_SESSION)) {
    header("Location: ./login.php");
    exit();
}

$connection = Connection::Connect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MATERIAL ICONS GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- LINK BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- LINK CSS -->
    <link rel="stylesheet" href="./src/css/global.css">

    <title>Home</title>
</head>

<body class="bg">

    <div class="container mt-3">

        <!-- SIDEBAR -->
        <?php require "./src/widgets/navigation/sidebar.php"; ?>

        <nav class="d-flex justify-content-between align-items-center mb-4">
            <a class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="offcanvasExample">
                <span class="material-symbols-outlined pt-2">
                    menu
                </span>
            </a>

            <div class="fw-bold fs-3 text-primary">
                Favoritos
            </div>

            <a href="./profile.html">
                <span class="material-symbols-outlined pt-2">
                    account_circle
                </span>
            </a>
        </nav>

    </div>


    <!-- LINK BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>