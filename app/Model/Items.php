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

    public static function verifyValues($name,$amount,$budget_id)
    {
        $error_alert=[];

        if ((empty($name))) {
            array_push($error_alert, "fill in the name");
        }

        if (empty($amount)) {
            array_push($error_alert, "fill in the amount");
        }

        if (empty($budget_id)) {
            array_push($error_alert, "select the budget Affected");
        }

        return $error_alert;

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

    public static function getItem($itemId){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM ".Items::TABLE." WHERE id=".$itemId." ";
        if($found=$db->query($query)){
            return $found->fetch(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    public static function deleteItems($BudgetNo){
        $db=(new Sqlite())->connect();
        $query="DELETE FROM ".Items::TABLE." WHERE budget_id=".$BudgetNo." ";
        if($db->query($query)){
            return true;
        }
        else{
            return false;
        }
    }

    public static function delete($item){
        $db=(new Sqlite())->connect();
        $query="DELETE FROM ".Items::TABLE." WHERE ".Items::TABLE.".id=".$item." ";
        if($db->query($query)){
            return true;
        }
        else{
            return false;
        }
    }

    public static function updateItem($data,$ItemId){
        $name=$data['name'];
        $budget_id=$data['budget_id'];
        $amount=$data['amount'];


        $db=(new Sqlite())->connect();
        $query="UPDATE items SET `name`=:name, `amount`=:amount, `budget_id`=:budget_id WHERE `id`=$ItemId ";

        $querying=$db->prepare($query);

        $queried=$querying->execute([

            ':name' => $name,
            ':amount' => $amount,
            ':budget_id'=>$budget_id,
        ]);

        if($queried){
            return true;
        }
        else{
            echo"Update not working";
        }
    }

}