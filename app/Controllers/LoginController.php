<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/8/16
 * Time: 7:25 AM
 */

namespace App\Controllers;
use App\SQLiteConnection;

use App\Controllers\SessionController as SessionController;

class LoginController
{

    private $db;
    private $password;
    private $email;

    //error Alert array to record errors
    private $errorAlert = array();
    private $InfoAlert = array();

    //this class is meant to handle all sign up query using the database parameters and value
    public function _construct(){
        $this->db=(new SQLiteConnection())->connect();
    }

    //function to verify input, the function verifies the input and returns and array to show the error level
    public function verifyValues($pass,$email)
    {
        if (!(empty($pass))) {
            $this->password=$pass;
        } else {
            array_push($this->errorAlert, "fill in the password section");
        }


        if (!empty($email)) {
            $this->email=$email;
        } else {
            array_push($this->errorAlert, "please enter an email");
        }

        return $this->errorAlert;

    }

    public function querying()
    {
        if (!$this->db) {
            $this->db=(new SQLiteConnection())->connect();
        }
        if ($this->db) {
            array_push($this->InfoAlert, "link successful");
            $query ="SELECT id FROM users WHERE password=:upass AND email=:email" ;
            $queryingg = $this->db->prepare($query);
            $executee=$queryingg->execute(array(':upass'=>$this->password,':email'=>$this->email));

            if ($executee) {
                array_push($this->InfoAlert, "query successful");
                if($queryingg->rowCount()>0){
                    array_push($this->InfoAlert, "row count worked");
                    $queryResult=$queryingg->fetch(\PDO::FETCH_ASSOC);
                    //if query exists verify the query
                    //then create a session based on it
                    $confirm_id=stripslashes($queryResult['id']);
                    $session=SessionController::createSession($confirm_id);

                    header("Location:yearview.php?key=$session");
                }else{
                    array_push($this->InfoAlert,"User does not exit in the database");
                }
            }
            else {
                array_push($this->InfoAlert, "Login process failed");
            }
        }else {
            array_push($this->InfoAlert, "Login process failed");
        }


        return $this->InfoAlert;
    }

}