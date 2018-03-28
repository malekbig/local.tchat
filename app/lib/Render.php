<?php
/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */

namespace App;


class Render
{
    /**
     * @param            $name
     * @param array|null $vars
     *
     * @return bool
     * @throws \Exception
     */
    public function view($name, array $vars = null)
    {

        $file = __DIR__.'/../../src/View/'.ucfirst($name).'View.php';
        if (is_file($file)) {
            if (isset($vars)) {
                extract($vars);
            }
            require($file);
            return true;
        }
        throw new \Exception('View issues');
    }

    /**
     * @param $name
     *
     * @return bool
     * @throws \Exception
     */
    public function model($name)
    {
        $model = "App\\Model\\".ucfirst($name).'Model';
        if (class_exists($model, true)) {
            $registry        = Config::getInstance();
            $registry->$name = new $model;
            return true;
        }
        throw new \Exception('Model issues.');
    }


}
