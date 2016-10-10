<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/6/16
 * Time: 7:29 PM
 */

namespace App\Model;
use App\SQLiteConnection as Sqlite;

class Budget
{
    private $db;
    const TABLE='budgets';


    public function _construct(){
        $this->db=(new Sqlite())->connect();

    }

    public function creating($request){
        $this->db=(new Sqlite())->connect();
        $name=$request['name'];
        $email=$request['amount'];
        $describ=$request['descrip'];
        $user_id=$request['user'];


        $query="INSERT INTO `".Budget::TABLE."`(`name`,`describ`,`user_id`)"."values(".$name.",".$describ.",".$user_id.")";
        $this->db->query($query);
    }

    public static function getAllBudget(){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM `".Budget::TABLE."` ";

        if($found=$db->query($query)){
            return $found->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    public function getBudget($budgetId){
        $this->db=(new Sqlite())->connect();
        $query="SELECT * FROM `".Budget::TABLE."` WHERE `id`=".$budgetId." ";
        if($found=$this->db->query($query)){
            return $found->fetch(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }



}