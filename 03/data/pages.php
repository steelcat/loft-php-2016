<?php

/**
 * @return string
 */
function page_login()
{
    return '<form method="post">
                <fieldset>
                    <legend>Вход</legend>
                    <p><label for="login">Логин</label><input type="text" name="login" id="login"></p>
                    <p><label for="password">Пароль</label><input type="password" name="password" id="password"></p>
                    <p><input type="submit" name="log"  value="Войти"></p>
                </fieldset>
            </form>';
}

/**
 * @return string
 */
function page_register()
{
    return '<form method="post">
                <fieldset>
                    <legend>Регистрация</legend>
                    <p><label for="reglogin">Логин</label><input type="text" name="reglogin" id="reglogin"></p>
                    <p><label for="regpassword">Пароль</label>
                    <input type="password" name="regpassword" id="regpassword"></p>
                    <p><input type="submit" name="reg"  value="Зарегистрироваться"></p>
                </fieldset>
            </form>';
}

/**
 * @param $page_data
 * @return string
 */
function page_profile($page_data)
{
    $image_print = '';
    if ($page_data['picture']) {
        $image_print = '<img src="photos/' . $page_data['picture'] . '">';
    }
    return '
        <form method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Профиль</legend>
                <p><label for="name">Имя</label>
                <input type="text" name="name" id="name" value="' . $page_data['name'] . '"></p>
                <p><label for="age">Возраст</label>
                <input type="number" name="age" id="age" value="' . $page_data['age'] . '"></p>
                <p><label for="about">О себе</label>
                <textarea rows="3" name="about" id="about">' . $page_data['about'] . '</textarea></p>
                <p><label for="picture">Фотография</label>
                <input type="file" name="picture" id="picture" value="' . $page_data['picture'] . '"></p>'
        . $image_print
        . '<p><input type="submit" name="update" value="Сохранить профиль"></p>
            </fieldset>
        </form>
        <form method="post">
            <input type="submit" name="logout" value="Выход">
        </form>
    ';
}

/**
 * @param $admin_data
 * @return string
 */
function page_admin($admin_data)
{
    $images_print = '<form method="post"><ul class="admin-list">';
    foreach ($admin_data as $image) {
        $image_file = 'photos/' . $image['picture'];
        $image_ext = get_file_ext($image['picture']);
        $image_filename = basename($image['picture'], '.' . $image_ext);
        if (file_exists(iconv("UTF-8", "CP1251", $image_file)) && is_file(iconv("UTF-8", "CP1251", $image_file))) {
            $images_print .= '
            <li class="admin-item clearfix">
            <img class="admin-image" src="' . $image_file . '">
            <input class="admin-image-name" name="'. $image['id'] .'" value="'. $image_filename .'">
            <div class="admin-image-ext">'. $image_ext .'</div>
            <div id="image-'. $image['id'] .'" class="admin-image-del">УДАЛИТЬ</div></li>';
        }
    }
    $images_print .=  '</ul></form>';
    return '
        <form method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Админка</legend>'
                . $images_print
            . '<p><input type="submit" name="admin" value="Сохранить"></p></fieldset>
        </form>';
}
