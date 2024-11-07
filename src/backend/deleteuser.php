<?php
// Inclui a classe Connection e Usuario
require_once '../classes/Connection.php';
require_once '../classes/Users.php';

$userId = $_GET['userId'];

$user = new Usuario();

if ($user->delete($userId)) {
    header('Location: ../../adminUsers.php');
} else {
    echo "Falha ao excluir o usuário com ID $idToDelete.";
}
