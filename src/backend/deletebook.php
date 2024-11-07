<?php
require_once '../classes/Connection.php';
require_once '../classes/Book.php';

// Verifica se o ID do livro foi passado na URL
if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    // Cria uma instância da classe Book
    $book = new Book('', '', '', '', '', '', '', '', '', '', '', '');

    // Chama a função deleteBook
    $deleted = $book->deleteBook($bookId);

    if ($deleted) {
        header('Location: ../../authorbooks.php');
    } else {
        echo "Erro ao excluir o livro.";
    }
} else {
    echo "ID do livro não fornecido.";
}
