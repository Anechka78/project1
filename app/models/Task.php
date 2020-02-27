<?php

namespace app\models;
use project\core\base\Model;


class Task extends Model{

    public $table = 'tasks';

    public function getOneTask($id){
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
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

        $old_task = $this->findOne($id, 'id', '')[0];
        if(trim($data['task']) != $old_task['task']){
            $data['edit'] = 1;
        }

        $res = $this->updateTable('tasks', $data, 'id', $id);
        if(($res == 1) && ($data['edit'] == 1)){
            $_SESSION['success'] = 'Задача отредактирована администратором. Изменения внесены успешно.';
        }elseif($res == 1){
            $_SESSION['success'] = 'Изменения внесены успешно.';
        }
        return $res;
    }

    public function updateTaskStatus($data){
        if(isset($data['id']) && isset($data['status'])){
            $newdata = [];
            $newdata['status'] = $data['status'];

            $res = $this->updateTable('tasks', $newdata, 'id', $data['id']);
            return $res;
        }
        return false;
    }

}