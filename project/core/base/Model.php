<?php
namespace project\core\base;

use project\core\Db;


abstract class Model{

    protected $pdo;
    protected $table;
    protected $pk = 'id';

    public function __construct(){
        $this->pdo = Db::instance();
    }

    /**
     * Надстройка над методом execute для запросов, в которых нужно в виде ответа получить true/false
     * @param $sql
     * @return bool
     */
    public function query($sql){
        return $this->pdo->execute($sql);
    }

    public function findAll($table=''){
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table";
        return $this->pdo->query($sql);
    }

    public function findOne($id, $field = '', $table=''){
        $table = $table ?: $this->table;
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM $table WHERE $field = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }

    public function findBySql($sql, $params = []){
        return $this->pdo->query($sql, $params);
    }

    public function findAllLimit($table = '', $start, $perpage){
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table LIMIT :start, :perpage";
        return $this->pdo->query($sql, array('start' => $start, 'perpage' => $perpage));
    }

    /**
     * Метод для вставки данных в таблицу БД
     * @param string $table - таблица, в которую будут добавлены данные
     * @param array $data - массив пар ключ-значение, где ключ - название столбца, в который будет внесено значение
     * @return true/false
     */
    public function insertInTable($table = '', $data){
        $table = $table ?: $this->table;
        $columns = 'DESCRIBE '.$table;
        $columnsArr = $this->pdo->query($columns, []);
        $newData = [];
        foreach($columnsArr as $arr){
            foreach($data as $k=>$v){
                    if($arr['Field'] == $k){
                        $newData[$k] = $v;
                    }
            }
        }
        $sql = 'INSERT INTO '. $table. '(`';
        $sql .= implode("`, `", array_keys($newData)).'`)';
        $sql .= ' VALUES (:';
        $sql .= implode(", :", array_keys($newData)).')';

        $this->pdo->execute($sql, $newData);

        return 1;
    }

    /**
     * @param $table - таблица, в которой проводим изменения
     * @param array $data массив поле-значение, которые подставляются в таблицу
     * @param string $field столбец, по которому понимаем, в какую строку вносить изменения, например id столбца
     * @param $str значение в столбце, которое говорит о том, где производить изменения
     */
    public function updateTable($table, array $data, $field, $str){
        $sql = 'UPDATE '. $table . ' SET ';
        foreach($data as $k=>$v){
            $sql .= $k . ' = :' . $k.', ';
        }
        $sql = substr($sql, 0, -2);
        $sql .= ' WHERE `'.$field.'` ='.$str;

        return $this->pdo->execute($sql, $data);
    }

}