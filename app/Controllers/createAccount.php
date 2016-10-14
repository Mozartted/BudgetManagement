<?php
require"../../vendor/autoload.php";

use App\Model\Account as Account;
use App\Model\Transaction as Transact;



if(isset($_POST['createAccount'])){
    session_destroy();
    $errorList=Account::verifyValues($_POST['name'],$_POST['describ'],$_POST['balance'],$_POST['type']);

    if(empty($errorList)){
        $status=Account::creating([
            'name'=>$_POST['name'],
            'balance'=>$_POST['balance'],
            'type'=>$_POST['type'],
            'describ'=>$_POST['describ']
        ]);

        if($status==true){
            echo("Created");
            session_start();
            $_SESSION['errorList']=$errorList;
            header("Location:../../public/account.php");

        }else{
            echo("Not Created");

        }
    }else{
        session_start();
        $_SESSION['errorList']=$errorList;
        header("Location:../../public/accountcreate.php");
    }

}

if(isset($_POST['createTransaction'])){
    $errorList=\App\Model\Transaction::verifyValues($_POST['name'],$_POST['describ'],$_POST['amount'],$_POST['type'],$_POST['account'],$_POST['date']);
    if(empty($errorList)){
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
            session_start();
            $_SESSION['errorList']=$errorList;
            header("Location:../../public/accountsView.php?account=$account");

        }else{
            echo("Not Created Transaction");

        }
    }else{
        session_start();
        $_SESSION['errorList']=$errorList;
        header("Location:../../public/editTransaction.php");
    }


}


if(isset($_POST['CreateBudget'])){
    $errorList=\App\Model\Budget::verifyValues($_POST['name'],$_POST['describ'],$_POST['year']);
    if(empty($errorList)){
        $status=\App\Model\Budget::creating(
            [
                'name'=>$_POST['name'],
                'describ'=>$_POST['describ'],
                'year'=>$_POST['year'],
            ]
        );

        if($status==true){
            echo("Created");
            session_start();
            $_SESSION['errorList']=$errorList;
            header("Location:../../public/yearview.php");

        }else{
            echo("Not Created Budget");

        }
    }else{
        session_start();
        $_SESSION['errorList']=$errorList;
        header("Location:../../public/createBudget.php");
    }



}

if(isset($_POST['CreateItem'])){
    $errorList=\App\Model\Items::verifyValues($_POST['name'],$_POST['amount'],$_POST['budget_id']);
    if(empty($errorList)){
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
            session_start();
            $_SESSION['errorList']=$errorList;
            header("Location:../../public/budgetview.php?budget=$budget");

        }else{
            echo("Not Created Budget");

        }
    }else{
        session_start();
        $_SESSION['errorList']=$errorList;
        header("Location:../../public/createItems.php");
    }

}

if(isset($_POST['CreateYear'])){
    $errorList=\App\Model\Items::verifyValues($_POST['name'],$_POST['begin'],$_POST['end']);
    if(empty($errorList)){
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
    }else{
        session_start();
        $_SESSION['errorList']=$errorList;
        header("Location:../../public/createyear.php");
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