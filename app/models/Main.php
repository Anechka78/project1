<?php

namespace app\models;

use project\core\base\Model;

class Main extends Model
{
    public $table = 'tasks';

    private $sort_field = ['name', 'email', 'status'];
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
        $sql = "SELECT t.*, u.name as name, u.email as email FROM {$this->table} AS t
                LEFT JOIN `users` AS `u` ON t.user_id = u.id";
        $tasks = $this->findBySql($sql, []);

        return $tasks;
    }

    public function getAllTasksBySort($sort_field, $sort_order){
        $sql = "SELECT t.*, u.name as name, u.email as email FROM {$this->table} AS t
                LEFT JOIN `users` AS `u` ON t.user_id = u.id ORDER BY {$sort_field} {$sort_order}";
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
    public function addNewTask($id, $desc, $status){
        $data=[];
        $data['user_id'] = $id;
        $data['task'] = $desc;
        $data['status'] = $status;
        $res = $this->insertInTable('tasks', $data);
        if($res){
            return true;
        }
        return false;
    }


}