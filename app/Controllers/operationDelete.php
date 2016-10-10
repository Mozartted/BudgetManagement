<?php
require"../../vendor/autoload.php";

use App\Model\Account as Account;
use App\Model\Transaction as Transact;



if(isset($_POST['DeleteAccount'])){

    $account=$_GET['account'];
    $status=Account::delete($account);

    if($status==true){
        echo("Created");
        header("Location:../../public/account.php");

    }else{
        echo("Not Created Not Deleted");

    }
}
