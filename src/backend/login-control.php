<?php
require_once '../classes/Connection.php';
require_once '../classes/Users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $email = $_POST['controlEmail'] ?? '';
    $password = $_POST['controlPassword'] ?? '';

    // Verifica se os campos não estão vazios
    if (!empty($email) && !empty($password)) {
        // Chama a função de login
        if (Usuario::login($email, $password)) {
            // Redireciona para o index.php caso o login seja bem-sucedido
            header('Location: ../../index.php');
            exit();
        } else {
            // Exibe uma mensagem de erro caso o login falhe
            echo 'Email ou senha incorretos.';
        }
    } else {
        echo 'Por favor, preencha todos os campos.';
    }
} else {
    header('Location: ../../login.php');
    exit();
}
