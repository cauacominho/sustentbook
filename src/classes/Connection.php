<?php

class Connection
{
    private static $dsn = 'mysql:host=localhost;dbname=sustentbook';
    private static $username = 'root';
    private static $password = '';

    public static $pdo = null;
    public function __construct() {}

    public static function Connect()
    {
        if (empty(self::$pdo)) {
            // Faz a conexão com o banco
            try {
                self::$pdo = new PDO(self::$dsn, self::$username, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Conectado com sucesso!";
            } catch (PDOException $e) {
                echo 'Erro: ' . $e->getMessage();
            }
        }

        return self::$pdo;
    }
}
