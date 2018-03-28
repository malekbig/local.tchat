<?php
/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */

namespace App;


abstract class Model
{
    protected $_config;
    protected $render;

    /**
     * Model constructor
     */
    public function __construct()
    {
        $this->_config = Config::getInstance();
        $this->render  = new Render();

    }

    /**
     * @param $key
     *
     * @return bool
     */
    final public function __get($key)
    {
        if ($return = $this->_config->$key) {
            return $return;
        }
        return false;
    }
}
