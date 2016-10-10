<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/8/16
 * Time: 7:40 AM
 */

namespace App\Model;
use App\SQLiteConnection as Sqlite;
use App\Model\Account;

class Transaction
{
    private $db;
    private $data;
    const TABLE='transactions';

    public function _construct(){
        $this->db=new Sqlite();
        $this->data=$this->db->connect();
    }

    //to create transactions, one has to collect
    //the current amount in account and update
    //it by the transaction

    //connecting to account and getting account

    public static function creating($request){
        $db=(new Sqlite())->connect();
        $name=$request['name'];
        $amount=$request['amount'];
        $transType=$request['type'];
        $descrip=$request['describ'];
        $acc_id=$request['account'];
        $datee=$request['date'];

        $account=Account::getAccount($acc_id);

        $currentBalance=$account['balance'];
        $balance=null;

        if($transType==0){
             $balance=$currentBalance-$amount;
        }elseif($transType==1){
            $balance=$currentBalance+$amount;
        }

        $update=Account::updateAccountAmount($acc_id,$balance);

        if($update==true){
            $query="INSERT INTO ".Transaction::TABLE."(name,description,amount,type,account,datee) VALUES(:name,:describ,:amount,:type,:account,:datee)";
            $querying=$db->prepare($query);

            $queried=$querying->execute([
                ':name'=>$name,
            ':describ'=>$descrip,
            ':amount'=>$amount,
            ':type'=>$transType,
            ':account'=>$acc_id,
            ':datee'=>$datee,
            ]);

            if($queried){
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }



    }

    public static function getTransact($TransactId){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM ".Transaction::TABLE." WHERE id=".$TransactId." ";
        if($found=$db->query($query)){
            return $found->fetch(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    //getting all in an array
    public function getAllTransactions(){
        $this->db=new Sqlite();
        $query="SELECT * FROM ".Transaction::TABLE." ";


        return $this->db->getArray($query);
    }

    public function getItems($itemId){
        $this->db=new Sqlite();
        $query="SELECT * FROM ".Transaction::TABLE." WHERE id=".$itemId." ";
        return $this->db->getArray($query);
    }

    public static function getAllTransactionsAccount($accountID){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM ".Transaction::TABLE." WHERE account=".$accountID." ";
        if($found=$db->query($query)){
            return $found->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    public static function deleteTransactions($accountNo){
        $db=(new Sqlite())->connect();
        $query="DELETE FROM ".\App\Model\Transaction::TABLE." WHERE account=".$accountNo." ";
        if($db->query($query)){
            return true;
        }
        else{
            return false;
        }
    }

    public static function deleteTransact($TransactNo){
        $db=(new Sqlite())->connect();
        $query="DELETE FROM ".\App\Model\Transaction::TABLE." WHERE id=".$TransactNo." ";
        if($db->query($query)){
            return true;
        }
        else{
            return false;
        }
    }
}