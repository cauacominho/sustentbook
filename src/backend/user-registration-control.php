<?php

require_once '../classes/Connection.php';
require_once '../classes/Users.php'; // Corrigi o nome da classe de Users para Usuario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $name = $_POST['controlNome'] ?? '';
    $email = $_POST['controlEmail'] ?? '';
    $phone = $_POST['controlTelefone'] ?? '';
    $password = $_POST['controlPassword'] ?? '';
    $access = isset($_POST['souAutor']) && $_POST['souAutor'] === 'author' ? 'author' : 'simple';

    // Cria um novo usuário
    $user = new Usuario($name, $email, $phone, $password, $access);

    // Tenta registrar o usuário
    if ($user->register()) {
        // Tenta logar o usuário automaticamente
        if ($user->login($email, $password)) { // Aqui, assume-se que o método login() está na classe Usuario
            session_start();
            $_SESSION['user_id'] = $user->getId();  // Método que você deve ter
            $_SESSION['user_name'] = $user->getName();
            $_SESSION['user_access'] = $user->getAccess();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['user_phone'] = $user->getPhone();

            // Redireciona para o index.php
            header('Location: ../../index.php');
            exit;
        } else {
            echo 'Erro ao logar o usuário após registro.';
        }
    } else {
        echo 'Erro ao registrar usuário.';
    }
} else {
    header('Location: ./sign-up.php');
    exit;
}
