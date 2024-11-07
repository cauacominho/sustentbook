<?php
require_once './src/classes/Connection.php'; // Certifique-se de que o caminho está correto
require_once './src/classes/Book.php';

// Verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $book = Book::getBookById($id); // Obtém o livro pelo ID
} else {
    // Redireciona ou mostra uma mensagem se o ID não for fornecido
    header('Location: ./index.php'); // Redireciona para a lista de livros
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- LINK BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- LINK CSS -->
    <link rel="stylesheet" href="./src/css/global.css">

    <title>Home</title>
</head>

<body class="bg">
    <?php if ($book):

        $pathParts = explode('/', htmlspecialchars($book['cover_image']));
        $partialPath = implode('/', array_slice($pathParts, 2, 3));
        // Extrair o nome do arquivo
        $fileName = end($pathParts);

    ?>

        <div class="container mt-3">



            <div class="d-flex justify-content-center position-relative mx-2 fixed-top">
                <a href="javascript:void(0);" onclick="window.history.back();">
                    <span class="material-symbols-outlined position-absolute start-0">
                        arrow_back
                    </span>
                </a>
            </div>

            <div class="container mt-5">
                <div>
                    <h2 class="text-primary fw-bold" style="font-size: 35px;"><?php echo htmlspecialchars($book['title']); ?></h2>

                    <img src="./src/img/imgsbook/back.png" class="w-100" alt="">

                    <div class="text-center text-primary">
                        <div class="fw-semibold fs-6"><?php echo htmlspecialchars($book['author']); ?></div>
                        <span class="material-symbols-outlined mt-2">
                            keyboard_arrow_down
                        </span>
                    </div>
                </div>
                <div style="height: 100px;"></div>
            </div>

        </div>
        <div class="bg-secondary text-primary py-4">
            <div class="container">
                <div class="fw-bold fs-1 p-3">
                    Sinopse
                </div>

                <p class="ms-3">
                    <?php echo htmlspecialchars($book['synopsis']); ?>
                </p>
            </div>
        </div>

        <div style="height: 50px;"></div>

        <div class="container text-primary pb-3">
            <div class="fw-bold fs-1 p-3">Detalhes</div>
            <div class="d-flex flex-nowrap overflow-auto">
                <div class="text-center me-3">
                    <span class="material-symbols-outlined">auto_stories</span>
                    <div><?php echo htmlspecialchars($book['pages']); ?> páginas</div>
                </div>
                <div class="text-center me-3">
                    <span class="material-symbols-outlined">language</span>
                    <div><?php echo htmlspecialchars($book['language']); ?></div>
                </div>
                <div class="text-center me-3">
                    <span class="material-symbols-outlined">apartment</span>
                    <div><?php echo htmlspecialchars($book['publisher']); ?></div>
                </div>
                <div class="text-center me-3">
                    <span class="material-symbols-outlined">calendar_month</span>
                    <div>
                        <?php
                        // Define o local para o idioma português
                        setlocale(LC_TIME, 'pt_BR.utf8');

                        // Converte a data em um objeto DateTime
                        $date = new DateTime($book['date']);

                        // Usa IntlDateFormatter para formatar a data
                        $formatter = new IntlDateFormatter(
                            'pt_BR', // Idioma para formatação
                            IntlDateFormatter::LONG, // Formato de data (longo inclui dia, mês por extenso e ano)
                            IntlDateFormatter::NONE // Sem formatação de hora
                        );

                        // Formata a data
                        echo $formatter->format($date);
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div id="carouselBooks" class="container py-4">
            <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Primeira Imagem (Ativa) -->
                    <div class="carousel-item active">
                        <img src="./src/assets/<?= $partialPath; ?>/<?= $fileName; ?>" class="d-block w-100" alt="Imagem Principal">
                    </div>
                    <!-- Outras Imagens -->
                    <?php foreach (explode(',', $book['other_images']) as $image) { ?>
                        <div class="carousel-item">
                            <img src="./src/assets/<?= $partialPath; ?>/<?= trim($image); ?>" class="d-block w-100" alt="Outras Imagens">
                        </div>
                    <?php } ?>
                </div>

                <!-- Controles de navegação -->
                <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>

            <!-- Botões de Controle (Thumbnails) -->
            <div class="d-flex justify-content-center align-items-center mt-3">
                <!-- Primeiro Botão (Ativo) -->
                <div class="mx-2">
                    <img src="./src/assets/<?= $partialPath; ?>/<?= $fileName; ?>" width="80" height="80" data-bs-target="#bookCarousel" data-bs-slide-to="0" class="img-thumbnail">
                </div>
                <!-- Outros Botões de Imagens -->
                <?php foreach (explode(',', $book['other_images']) as $index => $image) { ?>
                    <div class="mx-2">
                        <img src="./src/assets/<?= $partialPath; ?>/<?= htmlspecialchars(trim($image)); ?>" width="80" height="80" data-bs-target="#bookCarousel" data-bs-slide-to="<?php echo $index + 1; ?>" class="img-thumbnail">
                    </div>
                <?php } ?>
            </div>
        </div>



        <div style="height: 50px;"></div>

        <div class="bg-secondary text-primary">
            <div class="container px-4 py-4">
                <div class="fw-bold fs-2 text-start">
                    Para ler o livro:
                </div>
                <div class="text-start">
                    Escolha a quantidade de dias que deseja ficar com o livro:
                </div>

                <div class="mt-3">
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="btn-group" role="group" aria-label="Selector Example">
                            <button type="button" class="btn-outline-default btn-square active" onclick="selectDay(this)">1</button>
                            <button type="button" class="btn-outline-default btn-square" onclick="selectDay(this)">2</button>
                            <button type="button" class="btn-outline-default btn-square" onclick="selectDay(this)">3</button>
                            <button type="button" class="btn-outline-default btn-square" onclick="selectDay(this)">4</button>
                            <button type="button" class="btn-outline-default btn-square" onclick="selectDay(this)">5</button>
                            <button type="button" class="btn-outline-default btn-square" onclick="selectDay(this)">6</button>
                            <button type="button" class="btn-outline-default btn-square" onclick="addDay()"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="fs-5 mt-3 me-2" id="dayCount">1 dias com o livro.</div>
                </div>

                <div class="mt-4">
                    <!-- Dentro do HTML -->
                    <div>
                        <div>Total:</div>
                        <div id="valorfinal" class="fs-1">R$ <?php echo number_format($book['value'], 2, ',', '.'); ?></div>
                        <input type="hidden" id="bookValue" value="<?php echo htmlspecialchars($book['value']); ?>">
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn-white mt-3">Alugar</button>
                    </div>

                    <p class="mt-2 opacity-75">
                        A partir do valor arrecadado com este livro será destinado 60% a instituições cuja missão é cuidar do meio ambiente.
                    </p>
                </div>
            </div>
        </div>



        <script>
            function selectDay(button) {
                // Remove a classe 'active' de todos os botões
                const buttons = document.querySelectorAll('.btn-square');
                buttons.forEach(btn => btn.classList.remove('active'));

                // Adiciona a classe 'active' ao botão selecionado
                button.classList.add('active');

                // Atualiza o texto do parágrafo com o valor do botão selecionado
                const selectedValue = button.textContent;
                document.getElementById('dayCount').textContent = `${selectedValue} dias com o livro.`;

                // Pega o valor do livro do campo oculto
                const bookValue = parseFloat(document.getElementById('bookValue').value);

                // Calcula o valor total com base na quantidade de dias
                const totalValue = bookValue * parseInt(selectedValue, 10);

                // Atualiza o valor final na tela
                document.getElementById('valorfinal').textContent = `R$ ${totalValue.toFixed(2).replace('.', ',')}`;
            }

            function addDay() {
                // Pega o texto atual do parágrafo
                const currentText = document.getElementById('dayCount').textContent;
                const currentValue = parseInt(currentText, 10);

                // Adiciona 1 ao valor atual
                const newValue = currentValue + 1;

                // Atualiza o parágrafo com o novo valor
                document.getElementById('dayCount').textContent = `${newValue} dias com o livro.`;

                // Atualiza a classe active para o botão correspondente
                const buttons = document.querySelectorAll('.btn-square');
                buttons.forEach(btn => {
                    if (btn.textContent === newValue.toString()) {
                        btn.classList.add('active');
                    }
                });

                // Pega o valor do livro do campo oculto
                const bookValue = parseFloat(document.getElementById('bookValue').value);

                // Calcula o valor total com base na quantidade de dias
                const totalValue = bookValue * newValue;

                // Atualiza o valor final na tela
                document.getElementById('valorfinal').textContent = `R$ ${totalValue.toFixed(2).replace('.', ',')}`;
            }
        </script>


    <?php else: ?>
        <p>Livro não encontrado.</p>
    <?php endif; ?>


    <!-- LINK BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>