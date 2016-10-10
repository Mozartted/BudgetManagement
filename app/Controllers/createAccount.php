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

    if($status==true){
        echo("Created");
        header("Location:../../public/accountsView.php?account=$account");

    }else{
        echo("Not Created Transaction");

    }

}