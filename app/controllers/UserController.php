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

            $user = new User();
            $resData = [];
            if($user->login()){
                $_SESSION['success'] = 'Вы успешно авторизованы';

//                $resData['success'] = 1;
//                $resData['message'] = $_SESSION['success'];
//                $resData['user_login'] = $_SESSION['user']['login'];

            }else{
                $_SESSION['error'] = 'Логин/пароль введены неверно';
//                $resData['success'] = 0;
//                $resData['message'] = $_SESSION['error'];
            }
            redirect('/');
        }

    }

    public function logoutAction(){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect('/');
    }


}