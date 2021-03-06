<?php
namespace project\core;


class Db
{
    use TSingleton;

    protected $pdo;
    public static $countSql = 0;
    public static $queries = [];

    protected function __construct(){
        $db = require ROOT . '/config/config_db.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    /**
     * Вызываем метод, когда нужно выполнить sql запрос и данные из БД нам не нужны, важен ответ true/false
     * @param $sql
     * @return bool
     */
    public function execute($sql, $params = []){
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * @param $sql
     * @param array $params - параметры для подготовленного запроса к БД
     * @return array
     */
    public function query($sql, $params = []){
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if($res !== false){
            return $stmt->fetchAll();
        }
        return [];
    }

}