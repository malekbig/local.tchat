<?php
/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */

namespace App;


abstract class Controller
{
    protected $_config;
    protected $render;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        session_start();
        $this->_config = Config::getInstance();
        $this->render  = new Render();
    }

    /**
     * @return mixed
     */
    abstract public function index();

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

    /**
     * Deconnexion
     */
    public function Deconnexion()
    {
        unset($_SESSION["name"], $_SESSION["id"], $_SESSION["loggued"]);
        $this->RedirectOut();

    }

    /**
     * RedirectOut
     */
    public function RedirectOut()
    {
        header('Location:'.$this->_config->getParameters()["parameters"]["PATHAPP"]);

    }

    /**
     * Redirect To
     *
     * @param $to
     */
    public function RedirectTo($to)
    {
        header('Location:'.$this->_config->getParameters()["parameters"]["PATHAPP"].'/'.$to);

    }

    /**
     * @param $session
     */

    public function setSession($session)
    {
        $_SESSION["name"]    = $session->username;
        $_SESSION["id"]      = $session->id;
        $_SESSION["loggued"] = 1;

    }
}
