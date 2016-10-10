<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/7/16
 * Time: 9:56 AM
 */

namespace App\Model;
use App\SQLiteConnection as SQLite;

class Account
{
    private $db;
    private $data;
    const TABLE='accounts';


    public function _construct(){
        $this->db=new Sqlite();
        $this->data=$this->db->connect();
    }

    public static function creating($request){
        $db=(new Sqlite())->connect();
        $name=$request['name'];
        $balance=$request['balance'];
        $accountType=$request['type'];
        $descrip=$request['describ'];

        $query="INSERT INTO ".Account::TABLE."(name,describ,balance,type) VALUES(:name,:describ,:balance,:type)";
        $querying=$db->prepare($query);

        $queried=$querying->execute([

            ':name' => $name,
            ':describ' => $descrip,
            ':balance'=>$balance,
            ':type'=>$accountType,
        ]);

        if($queried){
            return true;
        }
        else{
            return false;
        }
    }


    public static function getAllAccount(){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM `".Account::TABLE."` ";

        if($found=$db->query($query)){
            return $found->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    public static function getAccount($AccountId){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM `".Account::TABLE."` WHERE `id`=".$AccountId." ";
        if($found=$db->query($query)){
            return $found->fetch(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    public static function updateAccountAmount($AccountId,$amount){
        $db=(new Sqlite())->connect();
        $query="UPDATE accounts SET balance=".$amount." WHERE id=".$AccountId." " ;
        if($db->query($query)){
            return true;
        }
        else{
            echo"Update not working";
        }
    }


}