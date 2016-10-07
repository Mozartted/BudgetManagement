<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/6/16
 * Time: 7:41 PM
 */

namespace App;


class SQLiteConnection
{
    private $pdo;

    private function _construct(){
        if($this->pdo==null){
            $this->pdo=new \PDO('sqlite:'.Config::PATH_TO_SQLITE_FILE,"","",array(
                \PDO::ATTR_PERSISTENT => true
            ));
        }
    }

    public function connect(){
        return $this->pdo;
    }



}