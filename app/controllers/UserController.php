<?php

namespace app\controllers;
use app\models\User;
use project\core\base\View;

class UserController extends AppController{

    public function indexAction(){
        View::setMeta('Страница авторизации', 'Описание страницы авторизации', 'Авторизация');
    }

    public function loginAction(){
        if(!empty($_POST)){
            if(empty(trim($_POST['login']))){
                $_SESSION['error'] = 'Логин не может быть пустым';
                redirect('/user/index');
            }
            if(empty(trim($_POST['password']))){
                $_SESSION['error'] = 'Пароль не может быть пустым';
                redirect('/user/index');
            }
            $user = new User();
            if($user->login()){
                $_SESSION['success'] = 'Вы успешно авторизованы';
            }else{
                $_SESSION['error'] = 'Логин/пароль введены неверно';
                redirect('/user/index');
            }
            redirect('/');
        }
        $_SESSION['error'] = 'Данных нет';
        redirect('/user/index');
    }

    public function logoutAction(){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect('/');
    }


}