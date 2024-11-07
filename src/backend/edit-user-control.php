<?php
// Inclui a classe Connection e Usuario
require_once '../classes/Connection.php';
require_once '../classes/Users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os valores do formulário
    $userId = $_POST['userId'];
    $name = $_POST['nameControl'];
    $email = $_POST['emailControl'];
    $tel = $_POST['telControl'];
    $token = $_POST['tokenControl'];
    $access = $_POST['accessControl'];

    // Instancia o usuário com os valores do formulário
    $user = new Usuario($name, $email, $tel, null, $access);
    $user->setToken($token); // Adicionando o token

    // Chama a função para atualizar o usuário
    if ($user->update($userId)) { // Passando o ID para o método update
        // Redireciona ou exibe uma mensagem de sucesso
        header('Location: ../../adminUsers.php?status=success');
        exit;
    } else {
        // Exibe uma mensagem de erro
        echo 'Erro ao editar usuário. Por favor, tente novamente.';
    }
} else {
    // Redireciona se o acesso não for via POST
    header('Location: ../index.php');
    exit;
}
