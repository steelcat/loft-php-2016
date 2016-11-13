<?php
require_once 'lib/functions.php';
require_once 'data/pages.php';

define('UPLOAD_DIR', __DIR__ . '/photos/');
define('IMG_EXTS', ['jpg', 'jpeg', 'png', 'gif']);

session_start();
$error = false;

if (empty($_SESSION['id'])) {
    if (isset($_POST['log'])) {
        $error = login();
    } elseif (isset($_POST['reg'])) {
        $error = register();
    }
    echo page_login();
    echo '<br><br>';
    echo page_register();
} else {
    if (isset($_POST['logout'])) {
        logout();
    } elseif (isset($_POST['update'])) {
        update();
    }
    echo page_profile($_SESSION['picture']);
}
if ($error) {
    echo '<br>' . "<div style='color: red'>$error</div>";
}
