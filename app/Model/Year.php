<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/10/16
 * Time: 7:27 PM
 */

namespace App\Model;
use App\SQLiteConnection as Sqlite;

class Year
{
    const TABLE="years";

    public function _construct(){
        $this->db=(new Sqlite())->connect();

    }

    public static function verifyValues($name,$begin,$end)
    {
        $error_alert=[];

        if ((empty($name))) {
            array_push($error_alert, "fill in the name");
        }

        if (empty($begin)) {
            array_push($error_alert, "select a beginning date");
        }

        if(empty($end)) {
            array_push($error_alert, "select an ending date");
        }


        return $error_alert;

    }

    public static function creating($request){
        $db=(new Sqlite())->connect();
        $name=$request['name'];
        $begin=$request['begin'];
        $end=$request['end'];

        $query="INSERT INTO ".Year::TABLE."(name,date_begin,date_end)"."values(:name,:begin,:end)";

        $querying=$db->prepare($query);

        $queried=$querying->execute([

            ':name' => $name,
            ':begin' => $begin,
            ':end'=>$end,

        ]);

        if($queried){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getAllYears(){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM ".Year::TABLE." ";
        if($found=$db->query($query)){
            return $found->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    //function to perform delete operations,You are suppose to know this kind of..
    public static function delete($year){
        $db=(new Sqlite())->connect();

        //deleting an account deletes the account and all transactions pertaining to that account.
        //in deleting transactions, we'll like to redo the account happenings,
        //expenses, add to balance, income removed from balance.

        //query to delete account
        $query="DELETE FROM ".Year::TABLE." WHERE id=".$year." ";
        if((Budget::deleteManyByYear($year))==true){
            $queryy=$db->query($query);
            if($queryy){
                return true;
            }
            else{
                echo "Year did not delete";
            }
        }else{

            return false;
        }
    }




}