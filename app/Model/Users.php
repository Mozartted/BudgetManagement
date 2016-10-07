<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/6/16
 * Time: 7:34 PM
 */

namespace App;
use App\SQLiteConnection as Sqlite;

class Users
{
    private $table='users';
    private $db;
    private $data;

    //creating users using the input paramenters
    public function _construct(){
        $this->db=new Sqlite();
        $this->data=$this->db->connect();


    }

    public function creating($request){
        $name=$request['name'];
        $email=$request['email'];
        $pass=$request['password'];

        $query="INSERT INTO `".$this->table."` values(".$name.",".$pass.",".$email.")";
        $this->data->query($query);
    }

    public function returnLoginUser($email,$pass){
        $query="SELECT * FROM `".$this->table."` WHERE `email`=".$email."and "."`password`=".$pass;

        $user=$this->db->query($query);

        return $user->fetch(\PDO::FETCH_ASSOC);
    }

    public function edit(){


    }

}