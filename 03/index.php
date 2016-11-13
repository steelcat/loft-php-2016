<?php
define('RUN', 'NORMAL');

require_once 'lib/db.php';
require_once 'lib/pages.php';

session_start();
$error = false;
$error_reg = false;

if (empty($_SESSION['id'])) {
    if (isset($_POST['log'])) {
        $login = isset($_POST['login']) ? $_POST['login'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;
        if ($login && $password) {
            $input_login = $_POST['login'];
            $input_password = $_POST['password'];
            $db = db_connect('localhost', 'loft-php-03');
            $query = $db->prepare("SELECT * FROM users WHERE login = '$input_login'");
            $query->execute();
            $user = $query->fetch();
            if ($user['login'] === $input_login && $user['password'] === $input_password) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['login'] = $user['login'];
                header('Location: /');
            } else {
                $error_login = "Логин или пароль введены неверно";
            }
        }
    } elseif (isset($_POST['reg'])) {
        $reglogin = isset($_POST['reglogin']) ? $_POST['reglogin'] : false;
        $regpassword = isset($_POST['regpassword']) ? $_POST['regpassword'] : false;
        if ($reglogin && $regpassword) {
            $input_reglogin = $_POST['reglogin'];
            $input_regpassword = $_POST['regpassword'];
            $db = db_connect('localhost', 'loft-php-03');
            $query = $db->prepare("SELECT * FROM users WHERE login='$input_reglogin'");
            $query->execute();
            $user = $query->fetch();
            if ($user['login'] != $input_reglogin) {
                $query = $db->prepare("INSERT INTO users(login, password)"
                    . "VALUES('$input_reglogin', '$input_regpassword')");
                $query->execute();
                header('Location: /');
            } else {
                $error_reg = "Такой логин уже есть в базе";
            }
        }
    } elseif (isset($_POST['logout'])) {
        $_SESSION = [];
        session_destroy();
        header('Location: /');
    }
    echo page_login();
    if ($error_login) {
        echo '<br>' . "<div style='color: red'>Ошибка входа: $error_login</div>";
    }
    echo '<br><br>';
    echo page_register();
    if ($error_reg) {
        echo '<br>' . "<div style='color: red'>Ошибка регистрации: $error_reg</div>";
    }
} else {
    echo page_profile();
}
