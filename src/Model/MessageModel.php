<?php
/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 * Time: 14:57
 */

namespace App\Model;


use App\Model;

class MessageModel extends Model
{
    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->_config->getRepository('message', "", ["LEFT JOIN user ON user.id=message.user"]);
    }

    /**
     * @param $datas
     *
     * @return bool
     */
    public function create($datas)
    {   //var_dump($datas);exit();
        return $this->_config->query_insert(
            'message',
            ["user" => $datas["user"], "message" => $datas["message"], "createdAt" => date('Y-m-d H:i:s')]
        );
    }

}