<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/9/16
 * Time: 5:53 AM
 */

namespace App\Model;
use App\SQLiteConnection as Sqlite;

class AccountType
{
    private $db;
    private $data;
    const TABLE='account_type';


    public function _construct(){
        $this->db=new Sqlite();
        $this->data=$this->db->connect();
    }

    public static function getAllAccount(){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM `".AccountType::TABLE."` ";

        if($found=$db->query($query)){
            return $found->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    public static function getAccountType($AccountId){
        $db=(new Sqlite())->connect();
        $query="SELECT * FROM `".AccountType::TABLE."` WHERE `id`=".$AccountId." ";
        if($found=$db->query($query)){
            return $found->fetch(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }


}