<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/7/16
 * Time: 10:01 AM
 */
namespace App\Controllers;

class SessionController{

    public static function createSession($key){
        session_start();
        if(isset($_SESSION['coded']))
            $_SESSION['coded']=$key;

        session_cache_expire(180);

        return $_SESSION['coded'];
    }

    public static function checkSessionKey(){
        $session=null;
        if(isset($_SESSION['coded']))
            $session=$_SESSION['coded'];

        return $session;
    }

    //simple logout section to log out current user and return them to index
    public static function logout(){
        //collects closes session and returns user to logout.
        session_destroy();
        return true;
    }
}

