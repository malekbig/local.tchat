<?php
namespace App\Model;

use App\Model;

/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */
class UserModel extends Model
{
    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->_config->getRepository('user');
    }

    /**
     * @param $datas
     *
     * @return bool
     */
    public function create($datas)
    {
        if(sizeof($this->findUserByUsernameAndPassword($datas))>0){
            return false;
        }
        return $this->_config->query_insert(
            'user',
            ["username" => $datas["username"], "password" => md5($datas["password"]), "connected" => 0]
        );
    }

    /**
     * @param $datas
     *
     * @return bool
     */
    public function findUserByUsernameAndPassword($datas)
    {

        return $this->_config->getRepository(
            'user',
            'AND username="'.$datas["username"].'" AND password= "'.md5($datas["password"]).'"'
        );


    }

    /**
     * @return array
     */
    public function findUserConnected()
    {

        return $this->_config->getRepository(
            'user',
            'AND connected= 1'
        );
    }

    /**
     * @param $data
     * @param $fields
     *
     * @return bool
     */
    public function update($data, $fields)
    {
        return $this->_config->update('user', $data, $fields);
    }


}