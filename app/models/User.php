<?php
namespace app\models;

use project\core\base\Model;

class User extends Model{

    public $table = 'admin';

    public function login(){
        $login    = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;

        if($login && $password){
            $sql = "SELECT * FROM {$this->table} WHERE login = ? LIMIT 1";
            $admin = $this->pdo->query($sql, [$login])[0];

            if($admin){
               if(password_verify($password, $admin['password'])){
                   $_SESSION['user']['login'] = $admin['login'];                   
                   return true;
               }
            }
        }
        return false;
    }



    /**
     * Проверка, авторизован пользователь или нет
     * @return bool
     */
    public static function isUser(){
        if(isset($_SESSION['user'])){
            return($_SESSION['user']);
        }else{
            return false;
        }
    }

    /**
     * Проверка, является ли пользователь администратором сайта
     * @return bool
     */
    public static function isAdmin(){
        return(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
    }


}