<?php
require"../../vendor/autoload.php";

use App\Model\Account as Account;
use App\Model\Transaction as Transact;



if(isset($_POST['createAccount'])){
    $status=Account::creating([
        'name'=>$_POST['name'],
        'balance'=>$_POST['balance'],
        'type'=>$_POST['type'],
        'user'=>$user_id,
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
        ]
    );

    if($status==true){
        echo("Created");
        header("Location:../../public/index.php");

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