<?php

class Usuario
{
    private $id, $token, $access, $name, $email, $phone, $password;

    public function __construct($name = "", $email = "", $phone = "", $password = "", $access = "")
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->access = $access;
        $this->token = bin2hex(random_bytes(16));
    }

    public function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function register()
    {
        if (!$this->isValidEmail($this->email)) {
            echo 'Email inválido.';
            return false;
        }

        try {
            $pdo = Connection::Connect();
            $sql = "INSERT INTO users (token, access, name, email, phone, password) VALUES (:token, :access, :name, :email, :phone, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':token', $this->token);
            $stmt->bindParam(':access', $this->access);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone', $this->phone);

            // Armazenando senha usando hash
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            // Armazenar o ID do usuário registrado
            $this->id = $pdo->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo 'Erro ao registrar usuário: ' . $e->getMessage();
            return false;
        }
    }


    public static function login($email, $password)
    {
        try {
            $pdo = Connection::Connect();
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                // Login bem-sucedido
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_access'] = $user['access'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_phone'] = $user['phone'];
                return true;
            } else {
                // Falha no login
                return false;
            }
        } catch (PDOException $e) {
            echo 'Erro ao fazer login: ' . $e->getMessage();
            return false; // Retorna falso em caso de erro
        }
    }

    public function getId()
    {
        return $this->id;
    }


    public static function inLoggedIn()
    {
        session_start();
        return isset($_SESSION['user_id']);
    }

    public static function logout($redirectTo = 'login.php')
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: $redirectTo");
        exit();
    }

    public static function getAllUsers()
    {
        try {
            $pdo = Connection::Connect();
            $sql = "SELECT id, token, access, name, email, phone FROM users";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Retorna todos os usuários como um array de objetos
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erro ao obter usuários: ' . $e->getMessage();
            return [];
        }
    }

    public function update($id) // Adicionando $id como parâmetro
    {
        try {
            $pdo = Connection::Connect();
            $sql = "UPDATE users SET token = :token, access = :access, name = :name, email = :email, phone = :phone WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':token', $this->token);
            $stmt->bindParam(':access', $this->access);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':id', $id); // Usando o ID passado como parâmetro

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Erro ao atualizar usuário: ' . $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $pdo = Connection::Connect();
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Retorna verdadeiro se um registro foi deletado
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo 'Erro ao deletar usuário: ' . $e->getMessage();
            return false; // Retorna falso em caso de erro
        }
    }



    // Métodos para definir e obter propriedades

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setAccess($access)
    {
        $this->access = $access;
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
