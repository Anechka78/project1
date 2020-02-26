<?php

namespace app\models;
use project\core\base\Model;


class Task extends Model{

    public $table = 'tasks';

    public function getOneTask($id){
        $sql = "SELECT t.*, u.name as name, u.email as email FROM {$this->table} AS t
                LEFT JOIN `users` AS `u` ON t.user_id = u.id WHERE t.id = ?";
        $task = $this->findBySql($sql, [$id])[0];

        return $task;
    }

    /**
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateTask($id, $data){
        if(isset($data['status'])){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }

        $data['user_id'] = $this->findOne($data['email'], 'email', 'users')[0]['id'];
        unset($data['email']);
        unset($data['name']);

        $res = $this->updateTable('tasks', $data, 'id', $id);
        return $res;
    }

}