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
        $_SESSION['coded']=$key;

        session_cache_expire(180);

        return $_SESSION['coded'];
    }

    public static function checkSessionKey(){
        $session=$_SESSION['coded'];

        return $session;
    }

}

