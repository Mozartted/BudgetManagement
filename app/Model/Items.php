<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/6/16
 * Time: 7:34 PM
 */

namespace App\Model;
use App\SQLiteConnection as Sqlite;

class Items
{
    private $db;
    private $data;
    const TABLE="items";

    public function _construct(){
        $this->db=new Sqlite();
        $this->data=$this->db->connect();
    }

    public function creating($request){
        $name=$request['name'];
        $value=$request['value'];
        $budget_id=$request['budget'];
        $status=0;


        $query="INSERT INTO `".Items::TABLE."(name,value,budget_id,status)"."` values(".$name.",".$value.",".$budget_id.",".$status.")";
        $this->data->query($query);
    }

    public static function getAllItemsInBudget($budgetid){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM `".Items::TABLE."` WHERE budget_id=".$budgetid." ";

        if($found=$db->query($query)){
            return $found->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    public function getItem($itemId){
        $this->db=(new Sqlite())->connect();
        $query="SELECT * FROM `".Items::TABLE."` WHERE `id`=".$itemId." ";
        if($found=$this->db->query($query)){
            return $found->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

}