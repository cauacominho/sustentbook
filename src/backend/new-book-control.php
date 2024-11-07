<?php

// Inclui a classe Book e inicia a conexão
require_once '../classes/Connection.php';
require_once '../classes/Book.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera dados do formulário
    $authorId = $_POST['authorIdControl'] ?? '';
    $authorName = $_POST['authorNameControl'] ?? '';
    $title = $_POST['titleBookControl'] ?? '';
    $synopsis = $_POST['synopsisBookControl'] ?? '';
    $pages = $_POST['pagesControl'] ?? '';
    $language = $_POST['languageControl'] ?? '';
    $publisher = $_POST['publisherControl'] ?? '';
    $translated = $_POST['translatedControl'] ?? '';
    $value = $_POST['valueControl'] ?? '';

    // Remove símbolo de moeda e espaços
    $value = str_replace("R$", "", $value);
    $value = trim($value);

    // Substitui o ponto por vírgula
    $value = str_replace(",", ".", $value);


    $title_underscores = str_replace(' ', '_', substr($title, 0, 50));

    // Diretório para salvar as imagens
    $uploadDir = "../assets/imgs-books/$authorId/$title_underscores/";

    // Cria o diretório, se não existir
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $coverImagePath = null;
    $otherImagesNames = [];

    // Verifica e move o arquivo da capa, se enviado
    if (isset($_FILES['coverFile']) && $_FILES['coverFile']['error'] === UPLOAD_ERR_OK) {
        $coverFileName = basename($_FILES['coverFile']['name']);
        $coverImagePath = $uploadDir . $coverFileName;  // Caminho completo
        move_uploaded_file($_FILES['coverFile']['tmp_name'], $coverImagePath);
    }

    // Verifica e move os arquivos das outras imagens, se enviados
    if (isset($_FILES['otherImages']) && is_array($_FILES['otherImages']['name'])) {
        foreach ($_FILES['otherImages']['name'] as $index => $fileName) {
            if ($_FILES['otherImages']['error'][$index] === UPLOAD_ERR_OK) {
                $otherImageName = basename($fileName);
                move_uploaded_file($_FILES['otherImages']['tmp_name'][$index], $uploadDir . $otherImageName);
                $otherImagesNames[] = $otherImageName; // Somente o nome do arquivo
            }
        }
    }

    // Converte os nomes das outras imagens em uma string separada por vírgulas
    $otherImagesString = implode(',', $otherImagesNames);

    // Cria uma nova instância da classe Book
    $book = new Book($authorId, $authorName, $title, $synopsis, $pages, $language, $publisher, $translated, $value, $coverImagePath, $otherImagesString);

    // Tenta adicionar o livro ao banco de dados
    if ($book->addBook()) {
        header('Location: ../../index.php');
    } else {
        echo "Erro ao adicionar livro.";
    }
}
