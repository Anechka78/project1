<?php

namespace project\core;

use project\core\Regisrty;

class App
{
    public static $app;

    public function __construct()
    {
        session_start();

        self::$app = Regisrty::instance();
        $this->getParams();
    }

    protected function getParams()
    {
        $params = require_once CONF . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
            }

        }
    }


}