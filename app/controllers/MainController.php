<?php
namespace app\controllers;

use app\models\Main;
use project\core\base\View;
use project\core\App;
use project\lib\Pagination;


class MainController extends AppController{

    public function indexAction(){
        $model = new Main;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sort_field = isset($_GET['sort']) ? $_GET['sort'] : false;
        $sort_order = isset($_GET['order']) ? $_GET['order'] : false;

        if(!empty($sort_field) && !empty($sort_order)){
            if($model->validateSortField($sort_field) && $model->validateSortOrder($sort_order)) {
                $alltasks = $model->getAllTasksBySort($sort_field, $sort_order);
            }else{
                redirect('/');
            }
        }else{
            $alltasks = $model->getAllTasks();
        }

        $perpage = App::$app->getProperty('pagination');
        $total = count($alltasks);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $tasks = array_slice($alltasks, $start, $perpage);
        $users = $model->findAll('users');

        View::setMeta('Страница задач', 'Описание страницы задач', 'Ключевые слова');

        $this->set(compact('tasks', 'pagination', 'total', 'users'));
    }

    public function addAction(){
        $model = new Main();
        if(!empty($_POST)){
            $data = $_POST;

            $user = $model->validateUser($data);
            if(!$user){
                $_SESSION['error'] = 'Такого пользователя не существует';
                redirect('/');
            }else{
                $task = $model->addNewTask($user['id'], $data['add_task_desk'], $status='0');
                if($task){
                    $_SESSION['success'] = 'Задача добавлена';
                    redirect('/');
                }
            }
        }
        $_SESSION['error'] = 'Произошла ошибка при добавлении задачи';
        redirect('/');
    }

    public function updateAction(){

        if(empty($_SESSION['user'])){
            $_SESSION['error']='У Вас нет прав доступа к данной странице';
            redirect('/');
        }

        $model = new Main;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sort_field = isset($_GET['sort']) ? $_GET['sort'] : false;
        $sort_order = isset($_GET['order']) ? $_GET['order'] : false;

        if(!empty($sort_field) && !empty($sort_order)){
            if($model->validateSortField($sort_field) && $model->validateSortOrder($sort_order)) {
                $alltasks = $model->getAllTasksBySort($sort_field, $sort_order);
            }else{
                redirect('/');
            }
        }else{
            $alltasks = $model->getAllTasks();
        }

        $perpage = App::$app->getProperty('pagination_admin');
        $total = count($alltasks);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $tasks = array_slice($alltasks, $start, $perpage);
        $users = $model->findAll('users');

        View::setMeta('Страница редактирования задач', 'Описание страницы редактирования задач', 'Ключевые слова');

        $this->set(compact('tasks', 'pagination', 'total', 'users'));
    }


}