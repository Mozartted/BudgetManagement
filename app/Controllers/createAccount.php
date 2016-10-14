<?php
require"../../vendor/autoload.php";

use App\Model\Account as Account;
use App\Model\Transaction as Transact;



if(isset($_POST['createAccount'])){
    $status=Account::creating([
        'name'=>$_POST['name'],
        'balance'=>$_POST['balance'],
        'type'=>$_POST['type'],
        'describ'=>$_POST['describ']
    ]);

    if($status==true){
        echo("Created");
        header("Location:../../public/account.php");

    }else{
        echo("Not Created");

    }
}

if(isset($_POST['createTransaction'])){
    $status=Transact::creating(
        [
            'name'=>$_POST['name'],
            'amount'=>$_POST['amount'],
            'type'=>$_POST['type'],
            'describ'=>$_POST['describ'],
            'account'=>$_POST['account'],
            'date'=>$_POST['date'],
        ]
    );

    $account=$_POST['account'];

    if($status==true){
        echo("Created");
        header("Location:../../public/accountsView.php?account=$account");

    }else{
        echo("Not Created Transaction");

    }

}


if(isset($_POST['CreateBudget'])){
    $status=\App\Model\Budget::creating(
        [
            'name'=>$_POST['name'],
            'describ'=>$_POST['describ'],
            'year'=>$_POST['year'],
        ]
    );

    if($status==true){
        echo("Created");
        header("Location:../../public/yearview.php");

    }else{
        echo("Not Created Budget");

    }
}

if(isset($_POST['CreateItem'])){
    $status=\App\Model\Items::creating(
        [
            'name'=>$_POST['name'],
            'amount'=>$_POST['amount'],
            'budget_id'=>$_POST['budget_id']
        ]
    );

    $budget=$_POST['budget_id'];

    if($status==true){
        echo("Created");
        header("Location:../../public/budgetview.php?budget=$budget");

    }else{
        echo("Not Created Budget");

    }

}

if(isset($_POST['CreateYear'])){
    $status=\App\Model\Year::creating(
        [
            'name'=>$_POST['name'],
            'begin'=>$_POST['begin'],
            'end'=>$_POST['end'],
        ]
    );

    if($status==true){
        echo("Created");
        header("Location:../../public/yearview.php");

    }else{
        echo("Not Created Budget");

    }
}


if(isset($_POST['logout'])){
    $status=\App\Controllers\SessionController::logout();
    if($status==true){
        header("Location:../../public/");

    }else{
        echo("Can't Log out");

    }

}