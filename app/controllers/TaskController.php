<?php

namespace app\controllers;
use app\controllers\AppController;
use app\models\Task;
use project\core\base\View;

class TaskController extends AppController{

    public function indexAction(){
        if(empty($_SESSION['user'])){
            $_SESSION['error']='У Вас нет прав доступа к данной странице. </br> <a href="/user/index">Перейти на страницу авторизации</a>';
            redirect('/');
        }
        $model = new Task();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : false;
        if(!empty($id)){
            $task = $model->getOneTask($id);

            View::setMeta("Страница редактирования задачи № ".$task['id'], 'Описание задачи', 'Ключевые слова');

            $this->set(compact('task'));
        }else{
            $_SESSION['error'] = 'Нет данных для редактирования';
            redirect('/main/update/');
        }
    }

    public function updateAction(){
        if(empty($_SESSION['user'])){
            $_SESSION['error']='У Вас нет прав доступа к данной странице. </br> <a href="/user/index">Перейти на страницу авторизации</a>';
            redirect('/');
        }
        $model = new Task();
        $data = $_POST;
        $id = isset($_GET['id']) ? (int)$_GET['id'] : false;

        if(!empty($id)){
            $task = $model->updateTask($id, $data);
            if($task){
                redirect('/main/update/');
            }

        }else{
            $_SESSION['error'] = 'Нет задачи для редактирования';
            redirect('/main/update/');
        }
    }

    public function updateCheckAction(){
        if(!empty($_POST)){
            $data = $_POST;
            $res = [];
            if(empty($_SESSION['user'])){
                $res['success'] = 0;
                $res['warning'] = 1;
                $res['message'] = 'У Вас нет прав доступа к данной странице. Авторизуйтесь!';
                echo json_encode($res);
                die;
            }
            $model = new Task();
            $status = $model->updateTaskStatus($data);
            if($status){
                $res['success'] = 1;
                $res['message'] = 'Статус задачи успешно обновлен';
            }else{
                $res['success'] = 0;
                $res['message'] = 'Статус задачи обновить не удалось';
            }
        }else{
            $res['message'] = 'Нет данных для смены статуса';
        }
        echo json_encode($res);
        die;
    }

}