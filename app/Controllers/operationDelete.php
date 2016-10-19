<?php
require"../../vendor/autoload.php";

use App\Model\Account as Account;




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

if(isset($_POST['DeleteBudget'])){

    $account=$_GET['budget'];
    $status=\App\Model\Budget::delete($account);

    if($status==true){
        echo("Created");
        header("Location:../../public/yearview.php");

    }else{
        echo("Not Created Not Deleted");

    }
}

if(isset($_POST['DeleteItem'])){

    $itemid=$_GET['item'];
    $itemInfo=\App\Model\Items::getItem($itemid);
    $idBudget=$itemInfo['budget_id'];
    $status=\App\Model\Items::delete($itemid);

    if($status==true){
        echo("Created");
        header("Location:../../public/budgetview.php?budget=$idBudget");

    }else{
        echo("Not Created Not Deleted");

    }
}

if(isset($_POST['DeleteTransact'])){

    $account=$_GET['account'];
    $TransInfo=\App\Model\Transaction::getTransact($account);
    $idAccount=$TransInfo['account'];
    $status=\App\Model\Transaction::deleteTransact($account);

    if($status==true){
        echo("Created");
        header("Location:../../public/account.php?account=$idAccount");

    }else{
        echo("Not Created Not Deleted");

    }
}

if(isset($_POST['DeleteYear'])){
    $year_id=$_GET['year'];
    $status=\App\Model\Year::delete($year_id);

    if($status==true){
        echo("Created");
        header("Location:../../public/yearview.php");

    }else{
        echo("Not Created Not Deleted");

    }
}
