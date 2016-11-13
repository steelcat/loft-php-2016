<?php
/**
 * @param string $db_host
 * @param string $db_name
 * @param string $db_username
 * @param string $db_password
 * @return array|PDO
 */
function db_connect($db_host, $db_name, $db_username = 'root', $db_password = '')
{
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    try {
        $connection = new PDO($dsn, $db_username, $db_password, $opt);
        return $connection;
    } catch (PDOException $e) {
        return [false, 'Database Error: ' . $e->getMessage()];
    }
}

/**
 * @return bool|string
 */
function login()
{
    $error = false;
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
            $error = "Логин или пароль введены неверно";
        }
    }
    return $error;
}

/**
 * @return bool|string
 */
function register()
{
    $error = false;
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
            $query = $db->prepare("INSERT INTO users(login, password) VALUES('$input_reglogin', '$input_regpassword')");
            $query->execute();
            header('Location: /');
        } else {
            $error = "Такой логин уже есть в базе";
        }
    }
    return $error;
}

/**
 * @return bool
 */
function logout()
{
    $_SESSION = [];
    session_destroy();
    header('Location: /');
    return false;
}

function update()
{
    $id = $_SESSION['id'];
    $input_name = $_POST['name'] ? strip_tags($_POST['name']) : null;
    $input_age = $_POST['age'] ? strip_tags($_POST['age']) : null;
    $input_about = $_POST['about'] ? strip_tags($_POST['about']) : null;
    $input_file = empty($_FILES['picture']) ? null : $_FILES['picture'];
    $input_file_tmp = empty($input_file['tmp_name']) ? null : $input_file['tmp_name'];
    $input_file_ext = strtolower(pathinfo($input_file['name'], PATHINFO_EXTENSION));
    $output_file_name = $id . '-' . uniqid() . '-' . time() . '.' . $input_file_ext;
    $output_file = UPLOAD_DIR . $output_file_name;
    move_uploaded_file($input_file_tmp, $output_file);
    $db = db_connect('localhost', 'loft-php-03');
    $query = $db->prepare('UPDATE users SET name = :name, age = :age, about = :about, picture = :picture WHERE id = :id');
    $query->execute(['name' => $input_name, 'age' => $input_age, 'about' => $input_about, 'picture' => $output_file_name, 'id' => $id]);
    header('Location: /');
}