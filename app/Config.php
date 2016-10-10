<?php
/**
 * Created by PhpStorm.
 * User: mozart
 * Date: 10/6/16
 * Time: 7:43 PM
 */

namespace App;

mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=utf-8');
session_start();



class Config
{

//GLOBAL CONFIGURATION

const DATABASE_USERNAME="root";
const PASSWORD="mozart";


const HOST="localhost";
const DATABASE_NAME="finance";

//GLOBAL DEFINITONS
const NAME='Budget';
const WWW='http://budget';

const ASSETS='assets';

    const PATH_TO_SQLITE_FILE="../database/budget.sqlite";
}