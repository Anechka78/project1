<?php

namespace app\models;

use project\core\base\Model;

class Main extends Model
{
    public $table = 'tasks';
    private $patternArr = [
        'email' => '/^([.a-z0-9_-]+)@([.a-z0-9-_]+)\.([a-z0-9_-]{1,6})$/i',
    ];

    private $sort_field = ['user_name', 'user_email', 'status'];
    private $sort_order = ['ASC', 'DESC'];

    public function validateSortField($sort_field){
        if(!in_array($sort_field, $this->sort_field)){
            $_SESSION['error'] = 'Недопустимое значение поля';
            return false;
        }
        return true;
    }

    public function validateSortOrder($sort_order){
        if(!in_array($sort_order, $this->sort_order)){
            $_SESSION['error'] = 'Недопустимое значение сортировки';
            return false;
        }
        return true;
    }

    public function getAllTasks(){
        $tasks = $this->findAll();
        return $tasks;
    }

    public function getAllTasksBySort($sort_field, $sort_order){
        $sql = "SELECT * FROM {$this->table} ORDER BY {$sort_field} {$sort_order}";
        $tasks = $this->findBySql($sql, []);

        return $tasks;
    }

    public function validateUser($data){
        $user = $this->findOne($data['add_task_user_email'], 'email', 'users')[0];
         if($user['name'] != $data['user_name']){
             return false;
         }
        return $user;
    }
    public function addNewTask($v){

        $data=[];
        if(empty(trim($v['add_task_desk']))){
            $_SESSION['error'] = 'Задача не может быть пустой!';
            return false;
        }elseif(empty(trim($v['user_name']))){
            $_SESSION['error'] = 'Пользователь должен быть указан!';
            return false;
        }elseif(!$this->checkEmail(trim($v['add_task_user_email']))){
            $_SESSION['error'] = 'E-mail указан некорректно!';
            return false;
        }
        $data['user_name'] = trim($v['user_name']);
        $data['user_email'] = trim($v['add_task_user_email']);
        $data['task'] = trim($v['add_task_desk']);
        $data['status'] = 0;
        $data['edit'] = 0;
        $res = $this->insertInTable('tasks', $data);
        if($res){
            return true;
        }
        return false;
    }

    public function checkEmail($email){
        return (preg_match($this->patternArr['email'], $email, $matches)===1)?true:false;
    }

}