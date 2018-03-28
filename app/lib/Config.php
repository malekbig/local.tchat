<?php
namespace App;

use PDO;

/**
 * Created by PhpStorm.
 * User: bmk
 * Date: 28/03/2018
 */
class Config
{
    private        $parameters;
    private        $pdo;
    private static $_instance;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->parameters = require(__DIR__.'/../config/parameters.php');
        $this->pdo        = $this->DbConnect($this->parameters);

    }

    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return \App\Config
     */
    public static function getInstance()
    {

        if (!self::$_instance instanceof self) {
            self::$_instance = new Config;
        }
        return self::$_instance;
    }

    /**
     * Connection a l base de donnée
     */
    public function DbConnect(array $param)
    {
        $conn = null;
        try {
            $conn = new PDO(
                'mysql:host='.$param["databases"]["DBHOST"].';dbname='.$param["databases"]["DBNAME"],
                $param["databases"]["DBUSER"],
                $param["databases"]["DBMDP"]
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
        }
        return $conn;
    }

    /**
     * @param        $table
     * @param string $filtre
     * @param array  $join
     * @param string $order
     * @param int    $debut
     * @param int    $limit
     *
     * @return array
     *
     */
    function getRepository($table, $filtre = "", $join = [], $order = "", $debut = 0, $limit = 0)
    {
        if ($table == "") {
            return [];
        }
        $retour = [];
        if (sizeof($join) > 0) {
            $addjoinrq = implode(" ", $join);
        } else {
            $addjoinrq = "";
        }
        if ($limit > 0) {
            $rqlimit = " LIMIT $debut,$limit";
        } else {
            $rqlimit = "";
        }
        if ($order != "") {
            $rqorder = "ORDER BY $order";
        } else {
            $rqorder = "";
        }
        //die("SELECT * FROM $table $addjoinrq WHERE 1 $filtre $rqorder $rqlimit");
        $r = $this->pdo->query("SELECT * FROM $table $addjoinrq WHERE 1 $filtre $rqorder $rqlimit");
        while ($t = $r->fetch(\PDO::FETCH_OBJ)) {
            $retour[] = $t;
        }
        return $retour;
    }

    /**
     * @param $pdo
     * @param $table
     * @param $id
     * @param $fields
     *
     * @return bool
     */
    function update($table, $id, $fields)
    {
        $set = '';
        $x   = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = \"{$value}\"";
            if ($x < count($fields)) {
                $set .= ',';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * @param $table
     * @param $id
     *
     * @return bool
     */
    function delete($table, $id)
    {

        if ($this->pdo->exec('DELETE FROM '.$table.' WHERE id = '.$id)) {
            return true;
        } else {
            return false;
        }

    }


    /**
     * @param $table
     * @param $data
     *
     * @return bool
     */
    function query_insert($table, $data)
    {
        $bind = ':'.implode(',:', array_keys($data));
        $sql  = 'INSERT INTO '.$table.'('.implode(',', array_keys($data)).') '.'VALUES ('.$bind.')';
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array_combine(explode(',', $bind), array_values($data)))) {
            return true;
        }
        return false;
    }

    /**
     * @param $table
     * @param $data
     *
     * @return bool
     */
    function query_insert_id($table, $data, $pdo)
    {
        $bind = ':'.implode(',:', array_keys($data));
        $sql  = 'INSERT INTO '.$table.'('.implode(',', array_keys($data)).') '.'VALUES ('.$bind.')';
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array_combine(explode(',', $bind), array_values($data)))) {
            return $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }
}