<?php
/**
 * Improved 'echo' function
 * @param $arr
 * @param null $name
 */
function debug($arr, $name=NULL){
    if ($name)
        echo '</br>'.'>>> '.$name.':'.'</br>';
    echo '<pre>'. print_r($arr, true) .'</pre>';
}

/**
 * URL to redirect
 * @param bool|false $http
 */
function redirect($http = false){
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header("Location: $redirect");
    die;
}

/**
 * @param $str
 * @return string
 */
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

