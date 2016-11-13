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
                    <p><label for="regpassword">Пароль</label><input type="password" name="regpassword" id="regpassword"></p>
                    <p><input type="submit" name="reg"  value="Зарегистрироваться"></p>
                </fieldset>
            </form>';
}

/**
 * @return string
 */
function page_profile($picture)
{
    return '<form method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Профиль</legend>
                    <p><label for="name">Имя</label><input type="text" name="name" id="name"></p>
                    <p><label for="age">Возраст</label><input type="number" name="age" id="age"></p>
                    <p><label for="about">О себе</label><textarea rows="3" name="about" id="about"></textarea></p>
                    <p><label for="picture">Фотография</label><input type="file" name="picture" id="picture"></p>
                    <p><input type="submit" name="update"  value="Сохранить профиль"></p>
                </fieldset>
            </form>
            <form method="post">
                <input type="submit" name="logout" value="Выход">
            </form>';
}
