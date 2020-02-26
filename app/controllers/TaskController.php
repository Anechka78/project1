<?php

namespace app\controllers;
use app\controllers\AppController;
use app\models\Task;
use project\core\base\View;

class TaskController extends AppController{

    public function indexAction(){
        if(empty($_SESSION['user'])){
            $_SESSION['error']='У Вас нет прав доступа к данной странице';
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
            $_SESSION['error']='У Вас нет прав доступа к данной странице';
            redirect('/');
        }
        $model = new Task();
        $data = $_POST;
        $id = isset($_GET['id']) ? (int)$_GET['id'] : false;

        if(!empty($id)){
            $task = $model->updateTask($id, $data);
            if($task){
                debug('hhhhhhh');
                $_SESSION['success']='Изменения внесены успешно';
                redirect('/main/update/');
            }


        }else{
            $_SESSION['error'] = 'Нет задачи для редактирования';
            redirect('/main/update/');
        }
    }

}