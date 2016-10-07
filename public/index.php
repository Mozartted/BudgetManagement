<?php
require '../vendor/autoload.php';


/**
The Index page would chack if a user exist and
 * if they do they would automatically be launched
 * into the budget view.



 **/
use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();
if ($pdo != null)
    echo 'Connected to the SQLite database successfully!';
else
    echo 'Whoops, could not connect to the SQLite database!';