<?php
session_start();

require_once './src/classes/Connection.php'; // Certifique-se de que o caminho está correto
require_once './src/classes/Book.php';

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

$books = Book::getBooksByAuthorId($userId);

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

    <title>Home</title>
</head>

<body class="bg">

    <div class="container mt-3">

        <div class="d-flex justify-content-center position-relative mx-2">
            <a href="./index.php">
                <span class=" material-symbols-outlined position-absolute start-0">
                    arrow_back
                </span>
            </a>

            <div class="fs-5 fw-bold text-primary text-center w-100">Meus livros</div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="search-container my-3" style="width: 400px;">
                <div type="submit" class="material-symbols-outlined search-icon">search</div>
                <input class="input-search" type="text" name="searchAll" id="searchAll" placeholder="Pesquisar" autocomplete="off">
            </div>
        </div>

        <div>
            <!-- Tabela de livros -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%;">ID</th>
                            <th scope="col" style="width: 70%;">Título</th>
                            <th scope="col" style="width: 20%;">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="bookTableBody">
                        <?php if (!empty($books)): ?>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($book['id']); ?></td>
                                    <td class="text-truncate" style="max-width: 0;">
                                        <?php echo htmlspecialchars($book['title']); ?>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editBook-<?= $book['id'] ?>" class="btn btn-white btn-sm mb-1 mb-md-0 me-md-1 w-100">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="./src/backend/deletebook.php?book_id=<?= $book['id'] ?>" class="btn btn-default btn-sm w-100">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            <?php
                                require "./src/widgets/modal/edit-book.php";
                            endforeach;
                            ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">Nenhum livro encontrado.</td>
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
            const rows = document.querySelectorAll('#bookTableBody tr');

            rows.forEach(row => {
                const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase().trim();
                if (title.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>