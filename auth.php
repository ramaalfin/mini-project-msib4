<?php 
require_once 'koneksi.php';

$users = new User($dbh);

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $users->register($username, $email, $password);
}

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users->login($username, $password);
}

if (isset($_POST['logout'])) {
    $users->logout();
}

class User {
    private $dbh;

    function __construct($dbh) {
        $this->dbh = $dbh;
    }

    function login($username, $password) {
        $stmt = $this->dbh->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            ];

            $_SESSION['welcome_message'] = 
            '<div class="alert alert-primary alert-dismissible" id="notif" role="alert">'
                . 'Selamat datang, ' . $user['username']
                . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
            . '</div>';

            if ($_SESSION['user']['username'] == 'admin') {
                header('Location: admin/pelanggan/index.php');
                echo $_SESSION['user'];
                exit();
            } else {
                header('Location: index.php');
                exit();
            }
        } else {
            echo "username atau password salah";
            header('Location: login.php');
            exit();
        }
    }

    function register($username, $email, $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->dbh->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $result = $stmt->execute([
            'username' => $username, 
            'email' => $email,
            'password' => $password
        ]);

        if($result) {
            header('Location: index.php');
            exit();
        } else {
            header('Location: register.php');
            exit();
        }
    }

    function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

?>