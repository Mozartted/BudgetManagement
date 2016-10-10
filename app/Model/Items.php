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

    public static function creating($request){
        $db=(new Sqlite())->connect();
        $name=$request['name'];
        $amount=$request['amount'];
        $budget_id=$request['budget_id'];



        $query="INSERT INTO ".Items::TABLE."(name,amount,budget_id)"." values(:name,:amount,:budget_id)";

        $querying=$db->prepare($query);

        $queried=$querying->execute([
            ':name' => $name,
            ':amount'=>$amount,
            ':budget_id'=>$budget_id
        ]);

        if($queried){
            return true;
        }
        else{
            return false;
        }
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