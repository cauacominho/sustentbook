<?php
session_start();

require_once './src/classes/Connection.php'; // Certifique-se de que o caminho está correto
require_once './src/classes/Book.php';

if (empty($_SESSION)) {
    header("Location: ./login.php");
    exit();
}

$connection = Connection::Connect();

$books = Book::getAllBooks();

// Aqui você pode acessar os dados da sessão
$userName = $_SESSION['user_name'] ?? 'Visitante';
$userEmail = $_SESSION['user_email'] ?? 'Não definido';
$userAccess = $_SESSION['user_access'] ?? 'Simples';

if ($_SESSION['user_access'] == 'admin') {
    header("Location: ./adminBooks.php");
    exit();
}
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
    <link rel="stylesheet" href="./src/css/global.css">
    <title>Home</title>
</head>

<body class="bg">
    <div class="container mt-3">
        <nav class="d-flex justify-content-between align-items-center bg mb-4">
            <a class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
                <span class="material-symbols-outlined pt-2">menu</span>
            </a>
            <div class="search-container">
                <div type="submit" class="material-symbols-outlined search-icon">search</div>
                <input class="input-search" type="text" name="searchAll" id="searchAll" placeholder="Pesquisar" autocomplete="off">
            </div>
            <a href="./profile.php">
                <span class="material-symbols-outlined pt-2">account_circle</span>
            </a>
        </nav>

        <!-- SIDEBAR -->
        <?php require "./src/widgets/navigation/sidebar.php"; ?>

        <!-- MODAL INFOS -->
        <?php require "./src/widgets/modal/infos-tags.php"; ?>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3" id="bookContainer">
            <?php foreach ($books as $book) :
                $pathParts = explode('/', htmlspecialchars($book['cover_image']));
                $partialPath = implode('/', array_slice($pathParts, 2, 3));
                $fileName = end($pathParts);
            ?>
                <div class="col cards-book d-block book-card">
                    <div class="card px-2 card-book">
                        <div class="d-flex justify-content-between align-items-start mt-4">
                            <a href="./bookdetails.php?id=<?php echo $book['id']; ?>" class="d-flex justify-content-between align-items-center">
                                <div class="ps-2">
                                    <?php if (!empty($book['cover_image'])) : ?>
                                        <img src="./src/assets/<?= $partialPath; ?>/<?= $fileName; ?>" alt="">
                                    <?php else : ?>
                                        <img src="./src/img/imgsbook/capa-default.png" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="px-3">
                                    <div class="fs-5 fw-bold text-primary book-title"><?php echo htmlspecialchars($book['title']); ?></div>
                                    <div class="text-secondary"><?php echo htmlspecialchars($book['author']); ?></div>
                                </div>
                            </a>
                            <a href="" class="text-end me-2 heart-icon">
                                <i class="fa-regular fa-heart fs-5"></i>
                            </a>
                        </div>
                        <div class="text-primary text-end infos-icon">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalVoluntario" class="link-infos text-primary">
                                <span class="material-symbols-outlined">volunteer_activism</span>
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalPlanta" class="link-infos text-primary ms-1">
                                <span class="material-symbols-outlined">psychiatry</span>
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalReciclagem" class="link-infos text-primary ms-1">
                                <span class="material-symbols-outlined">recycling</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- LINK BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.getElementById('searchAll').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase().trim();
            const bookCards = document.querySelectorAll('.book-card');

            bookCards.forEach(card => {
                const title = card.querySelector('.book-title').textContent.toLowerCase().trim();

                if (title.includes(searchValue)) {
                    card.classList.remove('d-none'); // Exibe o card
                } else {
                    card.classList.add('d-none'); // Oculta o card
                }
            });
        });
    </script>



</body>

</html>