<?php
/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */

namespace App;


class Request
{

    private $_controller;

    private $_method;

    private $_args;

    public function __construct()
    {
        $sources           = explode('/', $_SERVER['REQUEST_URI']);
        $sources           = array_filter(array_filter($sources));
        $this->_controller = ($c = array_shift($sources)) ? $c : 'index';
        $this->_method     = ($c = array_shift($sources)) ? $c : 'index';
        $this->_args       = (isset($sources[0])) ? $sources : [];
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getArgs()
    {
        return $this->_args;
    }
}
