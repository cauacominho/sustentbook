<?php

class Book
{
    private $id;
    private $authorId;
    private $author;
    private $title;
    private $synopsis;
    private $pages;
    private $language;
    private $publisher;
    private $translated;
    private $value;
    private $coverImage;
    private $otherImages;

    // Construtor
    public function __construct($authorId, $author, $title, $synopsis, $pages, $language, $publisher, $translated, $value, $coverImage, $otherImages, $id = null)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->author = $author;
        $this->title = $title;
        $this->synopsis = $synopsis;
        $this->pages = $pages;
        $this->language = $language;
        $this->publisher = $publisher;
        $this->translated = $translated;
        $this->value = $value;
        $this->coverImage = $coverImage;
        $this->otherImages = $otherImages;
    }

    // Adicionar livro
    public function addBook()
    {
        try {
            $pdo = Connection::Connect();
            $sql = "INSERT INTO books (author_id, author, title, synopsis, pages, language, publisher, translated, value, cover_image, other_images) VALUES (:author_id, :author, :title, :synopsis, :pages, :language, :publisher, :translated, :value, :cover_image, :other_images)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':author_id', $this->authorId);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':synopsis', $this->synopsis);
            $stmt->bindParam(':pages', $this->pages);
            $stmt->bindParam(':language', $this->language);
            $stmt->bindParam(':publisher', $this->publisher);
            $stmt->bindParam(':translated', $this->translated);
            $stmt->bindParam(':value', $this->value);
            $stmt->bindParam(':cover_image', $this->coverImage);
            $stmt->bindParam(':other_images', $this->otherImages);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Erro ao adicionar livro: ' . $e->getMessage();
            return false;
        }
    }

    // Editar livro
    public function editBook()
    {
        try {
            $pdo = Connection::Connect();
            $sql = "UPDATE books SET title = :title, synopsis = :synopsis, pages = :pages, language = :language, publisher = :publisher, translated = :translated, value = :value WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':synopsis', $this->synopsis);
            $stmt->bindParam(':pages', $this->pages);
            $stmt->bindParam(':language', $this->language);
            $stmt->bindParam(':publisher', $this->publisher);
            $stmt->bindParam(':translated', $this->translated);
            $stmt->bindParam(':value', $this->value);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Erro ao editar livro: ' . $e->getMessage();
            return false;
        }
    }

    // Excluir livro
    public function deleteBook($id)
    {
        try {
            $pdo = Connection::Connect();
            $sql = "DELETE FROM books WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Erro ao excluir livro: ' . $e->getMessage();
            return false;
        }
    }

    // Listar todos os livros
    public static function getAllBooks()
    {
        try {
            $pdo = Connection::Connect();
            $sql = "SELECT * FROM books"; // Certifique-se de que a tabela está correta
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna um array associativo com todos os livros
        } catch (PDOException $e) {
            echo 'Erro ao listar livros: ' . $e->getMessage();
            return []; // Retorna um array vazio em caso de erro
        }
    }

    // Obter todos os livros de um autor específico
    public static function getBooksByAuthorId($authorId)
    {
        try {
            $pdo = Connection::Connect();
            $sql = "SELECT * FROM books WHERE author_id = :author_id"; // Consulta baseada no author_id
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':author_id', $authorId, PDO::PARAM_INT); // Liga o parâmetro com o author_id
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna um array associativo com todos os livros do autor
        } catch (PDOException $e) {
            echo 'Erro ao obter livros do autor: ' . $e->getMessage();
            return []; // Retorna um array vazio em caso de erro
        }
    }


    // Obter livro por ID
    public static function getBookById($id)
    {
        try {
            $pdo = Connection::Connect();
            $sql = "SELECT * FROM books WHERE id = :id"; // Consulta com parâmetro para ID
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Liga o parâmetro com o ID
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna um array associativo com os dados do livro
        } catch (PDOException $e) {
            echo 'Erro ao obter livro: ' . $e->getMessage();
            return null; // Retorna null em caso de erro
        }
    }


    // Métodos para definir e obter propriedades
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
