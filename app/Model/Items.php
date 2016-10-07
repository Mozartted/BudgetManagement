<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/6/16
 * Time: 7:34 PM
 */

namespace App;
use App\SQLiteConnection as Sqlite;

class Items
{
    private $db;
    private $data;
    private $table='Item';

    public function _construct(){
        $this->db=new Sqlite();
        $this->data=$this->db->connect();
    }

    public function creating($request){
        $name=$request['name'];
        $value=$request['value'];
        $budget_id=$request['budget'];
        $status=0;


        $query="INSERT INTO `".$this->table."(name,value,budget_id,status)"."` values(".$name.",".$value.",".$budget_id.",".$status.")";
        $this->data->query($query);
    }
}