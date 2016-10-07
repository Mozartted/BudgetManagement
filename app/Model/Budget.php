<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/6/16
 * Time: 7:29 PM
 */

namespace App;
use App\SQLiteConnection as Sqlite;

class Budget
{
    private $db;
    private $data;
    private $table='Budget';


    public function _construct(){
        $this->db=new Sqlite();
        $this->data=$this->db->connect();
    }

    public function creating($request){
        $name=$request['name'];
        $email=$request['amount'];
        $descrip=$request['descrip'];
        $user_id=$request['user'];


        $query="INSERT INTO `".$this->table."(name,describ,user_id)"."` values(".$name.",".$descrip.",".$user_id.")";
        $this->data->query($query);
    }



}