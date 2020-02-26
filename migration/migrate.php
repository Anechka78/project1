<?php
require __DIR__. '/../vendor/autoload.php';
define('ROOT', dirname(__DIR__));

$db = \project\core\Db::instance();

foreach (scandir(__DIR__) as $fName){
    if (is_file($fName) && ($fName != basename(__FILE__))){
        echo 'file: '.$fName.'<br>';
        foreach (include __DIR__.'/'.$fName as  $k => $sql) {
            echo '&nbsp&nbsp&nbsp&nbsp'.'query '.$k.'<br>';
            $db->execute($sql);
        }


    }
}



