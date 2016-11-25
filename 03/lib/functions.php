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
 * @param $file_name_with_ext
 * @return string
 */
function get_file_ext($file_name_with_ext)
{
    return substr($file_name_with_ext, strrpos($file_name_with_ext, '.') + 1);
}

/**
 * @return bool|string
 */
function login()
{
    $error    = false;
    $login    = isset($_POST['login'])    ? $_POST['login'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;

    if ($login && $password) {
        $input_login    = $_POST['login'];
        $input_password = $_POST['password'];
        $db             = db_connect('localhost', 'loft-php-03');
        //ну это не лучший вариант
        //лучше создать отдельный конфигурационный файл и менять настройки
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
    $error       = false;
    $reglogin    = isset($_POST['reglogin'])    ? $_POST['reglogin'] : false;
    $regpassword = isset($_POST['regpassword']) ? $_POST['regpassword'] : false;

    if ($reglogin && $regpassword) {
        $input_reglogin    = $_POST['reglogin'];

        $input_regpassword = $_POST['regpassword'];
        $db                = db_connect('localhost', 'loft-php-03');
        $query             = $db->prepare("SELECT * FROM users WHERE login='$input_reglogin'");
        $query->execute();
        $user = $query->fetch();

        if ($user['login'] != $input_reglogin) {
            $query = $db->prepare("INSERT INTO users(login, password) VALUES('$input_reglogin', '$input_regpassword')");
            $query->execute();
            header('Location: /');
        } else {
            $error = 'Такой логин уже есть в базе';
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

/**
 *
 */
function update()
{
    $img_ext  = ['jpg', 'jpeg', 'png', 'gif'];
    $img_mime = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'];
    $id       = $_SESSION['id'];

    $input_name  = $_POST['name'] ? htmlentities(strip_tags(trim($_POST['name']))) : null;
    $input_age   = $_POST['age'] ? htmlentities(strip_tags(trim($_POST['age']))) : null;
    $input_about = $_POST['about'] ? htmlentities(strip_tags(trim($_POST['about']))) : null;
    $input_file  = $_FILES['picture']['size'] ? $_FILES['picture'] : null;
    $db          = db_connect('localhost', 'loft-php-03');

    if ($input_file) {
        $ext = get_file_ext($input_file['name']);
        $filename = $input_file['name'];
        $filetype = $input_file['type'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($input_file['error'] !== UPLOAD_ERR_OK) {
            $error = "Ошибка при загрузке файла";
            return $error;
        } elseif (!in_array($ext, $img_ext) || (!in_array($filetype, $img_mime))) {
            $error = "Допустима загрузка только файлов изображений";
            return $error;
        } else {
            $input_file_tmp = empty($input_file['tmp_name']) ? null : $input_file['tmp_name'];
            $input_file_ext = strtolower(pathinfo($input_file['name'], PATHINFO_EXTENSION));
            $output_file_name = $id . '-' . uniqid() . '-' . time() . '.' . $input_file_ext;
            $output_file = UPLOAD_DIR . $output_file_name;
            move_uploaded_file($input_file_tmp, $output_file);
            $query = $db->prepare('UPDATE users SET picture = :picture WHERE id = :id');
            $query->execute(['picture' => $output_file_name, 'id' => $id]);
        }

    }
    $query = $db->prepare('UPDATE users SET name = :name, age = :age, about = :about WHERE id = :id');
    $query->execute(['name' => $input_name, 'age' => $input_age, 'about' => $input_about, 'id' => $id]);
    header('Location: /');
}

/**
 * @return mixed
 */
function profile()
{
    $id = $_SESSION['id'];
    $db = db_connect('localhost', 'loft-php-03');
    $query = $db->prepare("SELECT * FROM users WHERE id = $id");
    $query->execute();
    $user = $query->fetch();
    return $user;
}

/**
 * @return mixed
 */
function admin()
{
    $id = $_SESSION['id'];
    $db = db_connect('localhost', 'loft-php-03');
    $query = $db->prepare("SELECT id,picture FROM users");
    $query->execute();
    $pictures = $query->fetchAll();
    return $pictures;
}

/**
 *
 */
function admin_update()
{
    array_pop($_POST);
    $db = db_connect('localhost', 'loft-php-03');
    $query = $db->prepare("SELECT id,picture FROM users");
    $query->execute();
    $original_pictures = $query->fetchAll();
    foreach ($original_pictures as $original_picture) {
        $new_image = null;
        $query = $db->prepare('UPDATE users SET picture = :picture WHERE id = :id');
        if ($_POST[$original_picture['id']]) {
            $new_image = htmlentities(strip_tags(trim($_POST[$original_picture['id']])))
                . '.' . get_file_ext($original_picture['picture']);
            rename(UPLOAD_DIR . $original_picture['picture'], UPLOAD_DIR . iconv("UTF-8", "CP1251", $new_image));
        } else {
            if (file_exists(UPLOAD_DIR . $original_picture['picture'])
                && is_file(UPLOAD_DIR . $original_picture['picture'])) {
                unlink(UPLOAD_DIR . $original_picture['picture']);
            }
        }
        $query->execute(['picture' => $new_image, 'id' => $original_picture['id']]);
    }
}

/**
 * @param string $page
 */
function page($page = '')
{
    echo "
        <!doctype html>
            <head>
                <meta charset=\"utf-8\">
                <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
                <title>Задание 3</title>
                <meta name=\"description\" content=\"\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
                <link rel=\"stylesheet\" href=\"css/main.css\">
            </head>
            <body>
                <div class=\"container\">
                    $page
                </div>
                <script src=\"//code.jquery.com/jquery-3.1.1.min.js\"></script>
                <script src=\"js/main.js\"></script>
            </body>
        </html>
    ";
}
