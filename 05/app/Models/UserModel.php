<?php
namespace App\Models;

use App\Model;

class UserModel extends Model
{
    public function id($id)
    {
        $db = $this->db;
        $query = $db->prepare("SELECT * FROM users WHERE id = '$id'");
        $query->execute();
        $user = $query->fetch();
        return $user;
    }

    public function login($login)
    {
        $db = $this->db;
        $query = $db->prepare("SELECT * FROM users WHERE login = '$login'");
        $query->execute();
        $user = $query->fetch();
        return $user;
    }

    public function register($input_login, $input_password)
    {
        $db = $this->db;
        $query = $db->prepare("INSERT INTO users(login, password) VALUES('$input_login', '$input_password')");
        $query->execute();
    }

    public function update($id, $name, $age, $about)
    {
        $db = $this->db;
        $query = $db->prepare('UPDATE users SET name = :name, age = :age, about = :about WHERE id = :id');
        $query->execute(['id' => $id, 'name' => $name, 'age' => $age, 'about' => $about]);
    }

    public function addPicture($user_id, $image)
    {
        $db = $this->db;
        $query = $db->prepare('INSERT INTO images(user_id, image) VALUES(:user_id, :image)');
        $query->execute(['user_id' => $user_id, 'image' => $image]);
        $query = $db->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
        $query->execute(['id' => $user_id, 'avatar' => $image]);
    }

    public function userFiles($user_id)
    {
        $db = $this->db;
        $query = $db->prepare("SELECT * FROM images WHERE user_id = :user_id");
        $query->execute(['user_id' => $user_id]);
        $userFiles = $query->fetchAll();
        return $userFiles;
    }

    public function allUsers()
    {
        $db = $this->db;
        $query = $db->prepare("SELECT * FROM users ORDER BY age ASC");
        $query->execute();
        $users = $query->fetchAll();
        return $users;
    }
}
