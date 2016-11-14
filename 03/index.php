<?php
require_once 'lib/functions.php';
require_once 'data/pages.php';

define('UPLOAD_DIR', __DIR__ . '/photos/');

session_start();
$error = false;
$page = '';

if (empty($_SESSION['id'])) {
    if (isset($_POST['log'])) {
        $error = login();
    } elseif (isset($_POST['reg'])) {
        $error = register();
    }
    $page .= '<div class="row">'
        . '<div class="col-xs-6">'. page_login() . '</div>'
        . '<div class="col-xs-6">'. page_register() . '</div>'
        . '</div>';
} else {
    if (isset($_POST['logout'])) {
        logout();
    } elseif (isset($_POST['update'])) {
        update();
    } elseif (isset($_POST['admin'])) {
        admin_update();
    }
    $page_data = profile();
    $admin_data = admin();
    $page .= '<div class="row">'
        . '<div class="col-xs-6">'. page_profile($page_data) . '</div>'
        . '<div class="col-xs-6">'. page_admin($admin_data) . '</div>'
        . '</div>';
}
if ($error) {
    $page .= "<div class='row'><div class='error'>$error</div></div>";
}
page($page);
