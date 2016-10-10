<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/6/16
 * Time: 7:41 PM
 */


namespace App;
class SQLiteConnection
{
    private $pdo;


    public function connect() {

        try{
            $this->pdo=new \PDO('mysql:host='.Config::HOST.';dbname='.Config::DATABASE_NAME,Config::DATABASE_USERNAME,Config::PASSWORD);
        }catch (\PDOException $err) {
            echo "harmless error message if the connection fails";
            file_put_contents('PDOErrors.txt', $err, FILE_APPEND);  // write some details to an error-log outside public_html
            die();  //  terminate connection
        }
        return $this->pdo;
    }



    public function getArray( $query ) {
        $args = func_get_args();
        array_shift( $args );
        $result = $this->pdo->query($query);
        $array = [];
        while( $item = $result->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $item;
        }
        return $array;
    }


}