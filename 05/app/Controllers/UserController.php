<?php
namespace App\Controllers;

use App\App;
use App\File;
use App\Controller;
use App\Models\UserModel;
use App\Sanitize;
use App\Session;
use App\View;

class UserController extends Controller
{
    protected $page_data = [];

    public function actionIndex()
    {
        if (Session::exists('id')) {
            if (App::existsPost('form_action')) {
                switch (App::getPost('form_action')) {
                    case 'logout':
                        $this->formActionLogout();
                        break;
                    case 'update':
                        $this->formActionUpdate();
                        break;
                }
            }
            $userModel = new UserModel('localhost', 'loft-php-05');
            $user = $userModel->id(Session::get('id'));
            View::show('user/index', ['user' => $user, 'error' => App::getError()]);
        } else {
            header('Location: /');
        }
    }

    public function actionLogin()
    {
        if (App::existsPost('form_action') && App::getPost('form_action') === 'login') {
            $this->formActionLogin();
        }
        View::show('user/login', ['error' => App::getError()]);
    }

    public function actionRegister()
    {
        if (App::existsPost('form_action') && App::getPost('form_action') === 'register') {
            $this->formActionRegister();
        }
        View::show('user/register', ['error' => App::getError()]);
    }

    public function actionFiles()
    {
        $userModel = new UserModel('localhost', 'loft-php-05');
        $userFiles = $userModel->userFiles(Session::get('id'));
        View::show('user/files', ['userFiles' => $userFiles]);
    }

    public function formActionLogin()
    {
        $login = App::existsPost('login') ? Sanitize::input(App::getPost('login')) : false;
        $password = App::existsPost('password') ? Sanitize::input(App::getPost('password')) : false;
        if ($login && $password) {
            $userModel = new UserModel('localhost', 'loft-php-05');
            $user = $userModel->login($login);
            if ($user['login'] === $login && $user['password'] === $password) {
                Session::set('id', $user['id']);
                header('Location: /user/index');
            } else {
                App::setError('Логин или пароль введены неверно');
            }
        } else {
            App::setError('Не введены логин или пароль');
        }
    }

    public function formActionRegister()
    {
        $reglogin = App::existsPost('reglogin') ? Sanitize::input(App::getPost('reglogin')) : false;
        $regpassword = App::existsPost('regpassword') ? Sanitize::input(App::getPost('regpassword')) : false;
        if ($reglogin && $regpassword) {
            $userModel = new UserModel('localhost', 'loft-php-05');
            $user = $userModel->login($reglogin);
            if ($user['login'] != $reglogin) {
                $userModel->register($reglogin, $regpassword);
                header('Location: /user/index');
            } else {
                App::setError('Такой логин уже есть в базе');
            }
        }
    }

    public function formActionUpdate()
    {
        $img_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $img_mime = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'];
        $id = Session::get('id');
        $input_name = $_POST['name'] ? Sanitize::input(App::getPost('name')) : null;
        $input_age = $_POST['age'] ? Sanitize::input(App::getPost('age')) : null;
        $input_about = $_POST['about'] ? Sanitize::input(App::getPost('about')) : null;
        $input_file = $_FILES['picture']['size'] ? $_FILES['picture'] : null;
        $userModel = new UserModel('localhost', 'loft-php-05');
        if ($input_file) {
            $ext = File::ext($input_file['name']);
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
                $userModel->addPicture($id, $output_file_name);
            }
        }
        $userModel->update($id, $input_name, $input_age, $input_about);
    }

    public function formActionLogout()
    {
        Session::destroy();
        header('Location: /');
    }
}
