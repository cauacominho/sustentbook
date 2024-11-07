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

            <div class="fs-5 fw-bold text-primary text-center w-100">Meu perfil</div>
        </div>

        <div class="mt-5">
            <div class="content-profile text-primary d-flex flex-column align-items-center justify-content-center mb-5">
                <img class="rounded-circle" src="./src/img/general/user_default.png" alt="">
                <div class="fw-bold fs-5 mt-3"><?= $userName ?></div>
                <div class="fw-light"><?= $userEmail ?></div>
            </div>

            <a href="" class="card px-3 mb-3" style="height: 80px;">
                <div class="text-primary d-flex justify-content-between align-items-center h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="material-symbols-outlined">
                            badge
                        </span>
                        <div class="ms-3">
                            <div class="fw-bold fs-5">Dados pessoais</div>
                            <div class="fw-light">Todos os seus dados pessoais</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
                    </span>
                </div>
            </a>
            <a href="" class="card px-3 mb-3" style="height: 80px;">
                <div class="text-primary d-flex justify-content-between align-items-center h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="material-symbols-outlined">
                            manage_accounts
                        </span>
                        <div class="ms-3">
                            <div class="fw-bold fs-5">Dados da conta</div>
                            <div class="fw-light">Dados da sua conta SUSTENTBOOK</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
                    </span>
                </div>
            </a>

            <a href="" class="card px-3 mb-3" style="height: 80px;">
                <div class="text-primary d-flex justify-content-between align-items-center h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="material-symbols-outlined">
                            lock
                        </span>
                        <div class="ms-3">
                            <div class="fw-bold fs-5">Segurança</div>
                            <div class="fw-light">Metodos de segurança da conta</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
                    </span>
                </div>
            </a>
            <a href="" class="card px-3 mb-3" style="height: 80px;">
                <div class="text-primary d-flex justify-content-between align-items-center h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="material-symbols-outlined">
                            credit_card
                        </span>
                        <div class="ms-3">
                            <div class="fw-bold fs-5">Pagamentos</div>
                            <div class="fw-light">Metodos de pagamento padrão</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
                    </span>
                </div>
            </a>

        </div>

    </div>



    <!-- LINK BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>