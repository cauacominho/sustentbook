<?php
session_start();

require_once './src/classes/Connection.php'; // Certifique-se de que o caminho está correto

if (empty($_SESSION)) {
    header("Location: ./login.php");
    exit();
}

$connection = Connection::Connect();

// Aqui você pode acessar os dados da sessão
$userName = $_SESSION['user_name'] ?? 'Visitante';
$userEmail = $_SESSION['user_email'] ?? 'Não definido';
$userAccess = $_SESSION['user_access'] ?? 'Simples';
$userPhone = $_SESSION['user_phone'] ?? 'Simples';
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

    <div class="container mt-4">
        <div class="d-flex justify-content-center position-relative mx-2">
            <a href="javascript:void(0);" onclick="window.history.back();">
                <span class="material-symbols-outlined position-absolute start-0">
                    arrow_back
                </span>
            </a>

            <div class="fs-5 fw-bold text-primary text-center w-100">Dados da conta</div>
        </div>

        <div class="mt-5">
            <div class="content-profile text-primary d-flex flex-column align-items-center justify-content-center mb-3">
                <img class="rounded-circle" src="./src/img/general/user_default.png" alt="">
                <a type="button" class="mt-3">Editar imagem</a>
            </div>

            <!-- Formulário centralizado -->
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <form action="#" method="post" class="text-center">

                        <div class="mb-3 position-relative">
                            <input type="text" name="nameControl" id="nameControl" class="form-default" value="<?= $userName ?>">
                        </div>

                        <div class="mb-3 position-relative">
                            <input type="email" name="emailControl" id="emailControl" class="form-default" value="<?= $userEmail ?>">
                        </div>

                        <div class="mb-3 position-relative">
                            <input type="tel" name="telControl" id="telControl" class="form-default" value="<?= $userPhone ?>">
                        </div>

                        <button type="submit" class="btn-default w-100 mb-1">Alterar dados</button>
                        <button type="submit" class="btn-white w-100">Cancelar</button>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="./src/js/cellular-adjustment.js"></script>

    <!-- LINK BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>