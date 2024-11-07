<div class="offcanvas offcanvas-start bg" data-bs-scroll="true" tabindex="-1" id="sidebar" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-body d-flex flex-column mt-3">
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <div class="fs-5">Olá, <?= $userName ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="text-body-tertiary"><?= $userAccess ?></div>
        </div>
        <ul class="nav nav-pills flex-column mb-auto sidebar">


            <?php if ($userAccess == 'simple') : ?>
                <li class="nav-item side-item">
                    <a href="./index.php" class="nav-link side-link d-flex justify-content-start align-items-end" aria-current="page">
                        <span class="material-symbols-outlined me-2">
                            home
                        </span>
                        Home
                    </a>
                </li>
                <li class="nav-item side-item">
                    <a href="./favorites.php" class="nav-link side-link d-flex justify-content-start align-items-end" aria-current="page">
                        <span class="material-symbols-outlined me-2">
                            favorite
                        </span>
                        Favoritos
                    </a>
                </li>
                <li class="nav-item side-item">
                    <a href="./" class="nav-link side-link d-flex justify-content-start align-items-end" aria-current="page">
                        <span class="material-symbols-outlined me-2">
                            auto_stories
                        </span>
                        Meus livros
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($userAccess == 'author') : ?>
                <li class="nav-item side-item">
                    <a href="./index.php" class="nav-link side-link d-flex justify-content-start align-items-end" aria-current="page">
                        <span class="material-symbols-outlined me-2">
                            home
                        </span>
                        Home
                    </a>
                </li>
                <li class="nav-item side-item">
                    <a href="./authorbooks.php" class="nav-link side-link d-flex justify-content-start align-items-end" aria-current="page">
                        <span class="material-symbols-outlined me-2">
                            collections_bookmark
                        </span>
                        Meus livros
                    </a>
                </li>
                <li class="nav-item side-item">
                    <a href="./newbook.php" class="nav-link side-link d-flex justify-content-start align-items-end" aria-current="page">
                        <span class="material-symbols-outlined me-2">
                            library_add
                        </span>
                        Novo livro
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($userAccess == 'admin') : ?>
                <li class="nav-item side-item">
                    <a href="./adminBooks.php" class="nav-link side-link d-flex justify-content-start align-items-end" aria-current="page">
                        <span class="material-symbols-outlined me-2">
                            library_books
                        </span>
                        Todos os livros
                    </a>
                </li>
                <li class="nav-item side-item">
                    <a href="./adminUsers.php" class="nav-link side-link d-flex justify-content-start align-items-end" aria-current="page">
                        <span class="material-symbols-outlined me-2">
                            group
                        </span>
                        Usuarios
                    </a>
                </li>
            <?php endif; ?>

        </ul>
        <footer class="mt-auto">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item side-item mb-3">
                    <a href="./src/backend/logout-control.php" class="nav-link text-danger fw-bold d-flex justify-content-start align-items-end">
                        Sair
                        <span class="material-symbols-outlined ms-2">
                            logout
                        </span>
                    </a>
                </li>
            </ul>
        </footer>
    </div>
</div>