<?php
session_start();

require_once './src/classes/Connection.php'; // Certifique-se de que o caminho está correto
require_once './src/classes/Users.php';

if (empty($_SESSION)) {
    header("Location: ./login.php");
    exit();
}

$connection = Connection::Connect();

// Aqui você pode acessar os dados da sessão
$userId = $_SESSION['user_id'] ?? '0';
$userName = $_SESSION['user_name'] ?? 'Visitante';
$userEmail = $_SESSION['user_email'] ?? 'Não definido';
$userAccess = $_SESSION['user_access'] ?? 'Simples';

$usuarios = Usuario::getAllUsers();

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- LINK CSS -->
    <link rel="stylesheet" href="./src/css/global.css">

    <title>Usuarios</title>
</head>

<body class="bg">

    <div class="container mt-3">

        <div class="d-flex justify-content-center position-relative mx-2">
            <a href="./index.php">
                <span class=" material-symbols-outlined position-absolute start-0">
                    arrow_back
                </span>
            </a>

            <div class="fs-5 fw-bold text-primary text-center w-100">Todos os usuarios</div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="search-container my-3" style="width: 400px;">
                <div type="submit" class="material-symbols-outlined search-icon">search</div>
                <input class="input-search" type="text" name="searchAll" id="searchAll" placeholder="Pesquisar nome de usuario" autocomplete="off">
            </div>
        </div>

        <div>
            <!-- Tabela de livros -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">ID</th>
                            <th scope="col" style="width: 20%;">Nome</th>
                            <th scope="col" style="width: 15%;">Email</th>
                            <th scope="col" style="width: 10%;">Telefone</th>
                            <th scope="col" style="width: 15%;">Token</th>
                            <th scope="col" style="width: 10%;">Acesso</th>
                            <th scope="col" style="width: 15%;">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                                    <td class="text-truncate" style="max-width: 0;"><?php echo htmlspecialchars($usuario['name']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['phone']); ?></td>
                                    <td class="text-truncate" style="max-width: 0;"><?php echo htmlspecialchars($usuario['token']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['access']); ?></td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editUser-<?= $usuario['id'] ?>" class="btn btn-white btn-sm mb-1 mb-md-0 me-md-1 w-100">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="./src/backend/deleteuser.php?userId=<?= $usuario['id'] ?>" class="btn btn-default btn-sm w-100">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                require "./src/widgets/modal/edit-user.php";
                            endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Nenhum usuário encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>


    <!-- LINK BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        document.getElementById('searchAll').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#userTableBody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase().trim();
                if (name.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>