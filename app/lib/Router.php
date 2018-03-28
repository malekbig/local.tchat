<?php
/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */

namespace App;


class Router
{
    /**
     * @param \App\Request $request
     *
     * @throws \Exception
     */
    public static function route(Request $request)
    {

        $controller = "App\\Controller\\".ucfirst($request->getController()).'Controller';
        $method     = $request->getMethod();
        $args       = $request->getArgs();

        if (class_exists($controller, true)) {
            $controller = new $controller;
            $method     = (is_callable([$controller, $method])) ? $method : 'index';

            if (!empty($args)) {
                call_user_func_array([$controller, $method], $args);
            } else {
                call_user_func([$controller, $method]);
            }
            return;
        }


        throw new \Exception('404 - '.$request->getController().' not found');
    }
}
