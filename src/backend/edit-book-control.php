<?php
// Inclui a classe Book e inicia a conexão
require_once '../classes/Connection.php';
require_once '../classes/Book.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $valueControl = str_replace(['R$', '.', ','], ['', '', '.'], $_POST['valueControl']);

    // Recupera os valores do formulário
    $bookId = $_POST['bookId'];
    $title = $_POST['titleControl'];
    $synopsis = $_POST['synopsisBookControl'];
    $pages = $_POST['pagesControl'];
    $language = $_POST['languageControl'];
    $publisher = $_POST['publisherControl'];
    $translated = $_POST['translatedControl'];
    $value = $valueControl; // Corrigido para $_POST

    // Instancia o livro com valores genéricos ou nulos para os atributos não usados aqui
    $book = new Book(null, null, $title, $synopsis, $pages, $language, $publisher, $translated, $value, null, null, $bookId);

    // Chama a função para atualizar o livro
    if ($book->editBook()) {
        // Redireciona ou exibe uma mensagem de sucesso
        header('Location: ../../authorbooks.php?status=success');
        exit;
    } else {
        // Exibe uma mensagem de erro
        echo 'Erro ao editar livro. Por favor, tente novamente.';
    }
} else {
    // Redireciona se o acesso não for via POST
    header('Location: ../index.php');
    exit;
}
