<?php

session_start();

$authorId = $_SESSION['user_id'] ?? null;
$authorName = $_SESSION['user_name'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MATERIAL ICONS GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- LINK BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- LINK CSS -->
    <link rel="stylesheet" href="./src/css/global.css">

    <title>Cadastrar</title>
</head>

<body class="bg">


    <div class="container d-flex flex-column justify-content-center mt-5">
        <!-- Título centralizado -->
        <div class="d-flex justify-content-center position-relative mx-2">
            <a href="javascript:void(0);" onclick="window.history.back();">
                <span class="material-symbols-outlined position-absolute start-0">
                    arrow_back
                </span>
            </a>

            <div class="fs-5 fw-bold text-primary text-center w-100">Novo Livro</div>
        </div>
        <!-- Formulário centralizado -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-6 col-lg-4">
                <form action="./src/backend/new-book-control.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="authorIdControl" value="<?= $authorId; ?>">
                    <input type="hidden" name="authorNameControl" value="<?= $authorName; ?>">

                    <fieldset>
                        <legend class="text-primary">Principal:</legend>

                        <!-- Capa do livro -->
                        <div class="mb-3">
                            <div class="mt-2">
                                <img id="coverPreview" style="max-width: 50%; display:none;" />
                            </div>
                            <div id="file-chosen-cover" class="mb-1"></div>
                            <input type="file" name="coverFile" id="coverFile" accept=".png, .jpg, .jpeg"
                                class="form-default" style="display: none;">
                            <button type="button" id="btnUploadCover" class="btn-white w-100">
                                <span class="d-flex justify-content-between align-items-center mx-2">
                                    Escolher capa do livro
                                    <i class="fa-solid fa-file-arrow-down ms-1"></i>
                                </span>
                            </button>
                            <span class="text-link-info">Diretrizes para a imagem de capa - <a href="#">Saiba mais</a></span>
                        </div>

                        <!-- Outras imagens -->
                        <div class="mb-3">
                            <div class="mt-2 d-flex flex-wrap gap-2" id="otherPreviewContainer">
                                <!-- As imagens serão inseridas aqui -->
                            </div>
                            <div id="file-chosen-other" class="mb-1"></div>
                            <input type="file" name="otherImages[]" id="otherImages" accept=".png, .jpg, .jpeg"
                                class="form-default" multiple style="display: none;">
                            <button type="button" id="btnUploadOther" class="btn-white w-100">
                                <span class="d-flex justify-content-between align-items-center mx-2">
                                    Escolher outras imagens do livro
                                    <i class="fa-solid fa-file-arrow-down ms-1"></i>
                                </span>
                            </button>
                            <span class="text-link-info">Diretrizes para a imagens do livro - <a href="#">Saiba mais</a></span>
                        </div>

                        <div class="mb-3">
                            <input type="text" name="titleBookControl" id="titleBookControl" placeholder="Título do Livro" class="form-default">
                        </div>

                        <div class="mb-3">
                            <textarea name="synopsisBookControl" id="synopsisBookControl" placeholder="Sinopse do Livro" class="textarea-default"></textarea>
                        </div>

                    </fieldset>

                    <fieldset>
                        <legend class="text-primary">Detalhes:</legend>

                        <div class="d-flex justify-content-center mb-2">
                            <input type="text" name="pagesControl" id="pagesControl" placeholder="Qtde. Paginas" class="form-default me-2">
                            <input type="text" name="languageControl" id="languageControl" placeholder="Idioma" class="form-default" value="Português">
                        </div>
                        <div class="d-flex justify-content-center mb-2">
                            <input type="text" name="publisherControl" id="publisherControl" placeholder="Editora" class="form-default me-2">
                            <input type="text" name="translatedControl" id="translatedControl" placeholder="Traduzido" class="form-default">
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend class="text-primary">Quanto quer receber por dia?</legend>

                        <div class="mb-3">
                            <input type="tel" name="valueControl" placeholder="R$ 0,00"
                                class="form-default currency-input"
                                oninput="CurrencyFormatter.format(this)"
                                onblur="CurrencyFormatter.validate(this)">
                            <div id="totalValue" class="mt-2"></div>
                        </div>


                    </fieldset>

                    <button type="submit" class="btn-default w-100 mb-5">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>



    <script>
        class CurrencyFormatter {
            static format(inputElement) {
                let value = inputElement.value.replace(/\D/g, ""); // Remove tudo que não for dígito
                value = (parseFloat(value) / 100).toFixed(2); // Converte para decimal com duas casas
                value = value.replace(".", ","); // Troca ponto por vírgula
                inputElement.value = "R$ " + value.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Formata com pontos para milhares
            }

            static validate(inputElement) {
                if (!inputElement.value.includes("R$")) {
                    inputElement.value = "R$ 0,00"; // Define o valor padrão se o campo estiver vazio ou incorreto
                }
            }
        }

        // Aplicação automática da formatação em todos os inputs com a classe .currency-input
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.currency-input').forEach(input => {
                input.addEventListener('input', () => CurrencyFormatter.format(input));
                input.addEventListener('blur', () => CurrencyFormatter.validate(input));
            });
        });
    </script>

    <script src="./src/js/image-preview.js"></script>

    <!-- LINK BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>