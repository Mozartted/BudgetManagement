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

    public static function verifyValues($name,$describ,$year)
    {
        $error_alert=[];

        if ((empty($name))) {
            array_push($error_alert, "fill in the name");
        }

        if (empty($describ)) {
            array_push($error_alert, "enter a description");
        }

        if (empty($year)) {
            array_push($error_alert, "select the budget year");
        }

        return $error_alert;

    }

    public static function creating($request){
        $db=(new Sqlite())->connect();
        $name=$request['name'];
        $describ=$request['describ'];
        $year=$request['year'];


        $query="INSERT INTO ".Budget::TABLE."(name,describ,year)"."values(:name,:describ,:year)";

        $querying=$db->prepare($query);

        $queried=$querying->execute([

            ':name' => $name,
            ':describ' => $describ,
            ':year'=>$year,

        ]);

        if($queried){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getAllBudget(){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM ".Budget::TABLE." ";

        if($found=$db->query($query)){
            return $found->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    public function getBudget($budgetId){
        $this->db=(new Sqlite())->connect();
        $query="SELECT * FROM ".Budget::TABLE." WHERE id=".$budgetId." ";
        if($found=$this->db->query($query)){
            return $found->fetch(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    public static function getBudgetInYear($yearID){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM ".Budget::TABLE." WHERE year=".$yearID." ";
        if($found=$db->query($query)){
            return $found->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    //function to perform delete operations,You are suppose to know this kind of..
    public static function delete($BudgetID){
        $db=(new Sqlite())->connect();

        //deleting an account deletes the account and all transactions pertaining to that account.
        //in deleting transactions, we'll like to redo the account happenings,
        //expenses, add to balance, income removed from balance.

        //query to delete account
        $query="DELETE FROM ".Budget::TABLE." WHERE id=".$BudgetID." ";
        if((Items::deleteItems($BudgetID))==true){
            $queryy=$db->query($query);
            if($queryy){
                return true;
            }
            else{
                echo "Transaction did not delete";
            }
        }else{

            return false;
        }
    }

    //function to perform delete operations,You are suppose to know this kind of..
    public static function deleteManyByYear($YearId){
        $BudgetInYear=Budget::getBudgetInYear($YearId);

        $statuss=null;
        foreach($BudgetInYear as $budget){
            $status=Budget::delete($budget['id']);
            if($status==true){
                $statuss=true;
            }
            else{
                $statuss=false;
            }
        }

        if($statuss==null){
            $statuss=true;
        }

        if($statuss==true){
            echo "Working";
        }else{
            echo "Not working";
        }
        return $statuss;
    }



}