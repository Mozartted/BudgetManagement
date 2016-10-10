<?php
include "../app/Controllers/SessionController.php";
use App\Controllers\SessionController;
use App\Model\Budget;
use App\Model\AccountType;
use App\Model\Transaction;
use App\Model\Account;

require_once '../vendor/autoload.php';

$session=SessionController::checkSessionKey();


if($session==$_GET['key']){

}else{
    header("Location:login.php");
}
$accountId=$_GET['account'];

$accountType=AccountType::getAllAccount();
$account=Account::getAllAccount();

//getting all in budget
$budgetList=Budget::getAllBudget();
$collectAccount=Account::getAllAccount();
$transactions=Transaction::getAllTransactionsAccount($accountId);

?>

<!DOCTYPE html>
<html class="" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Management</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/modern-business.css" rel="stylesheet">


</head>

<body>
<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="#">Budget Management</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</div>


<!--creating profile section-->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create Item
            </h1>
            <div class="row">
                </hr>
            </div>
        </div>
    </div>


    <div class="row" style="margin-top:50px;">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <div id="generalTabContent" class="tab-content responsive">
                <div id="alert-tab" class="tab-pane fade in active">
                    <div class="row">
                        <div class="panel panel-green">
                            <div class="panel-heading" style="color:#202020;">Create Items</div>
                            <div class="panel-body">
                                <!--Displays the users and their levels Admin or writer-->

                                <div>
                                    <form class="form-horizontal" role="form" method="POST" action="../app/Controllers/createAccount.php">
                                        <div class="form-group">
                                            <label for="name" class="col-md-4 control-label">Name</label>

                                            <div class="col-md-6">
                                                <input  class="form-control" name="name" value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-md-4 control-label">Amount</label>

                                            <div class="col-md-6">
                                                <input type="number" class="form-control" name="amount" value="" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-md-4 control-label">Budget</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="budget_id" value="" >

                                                    <?php
                                                    foreach($budgetList as $acc){
                                                        $ac_id=$acc['id'];
                                                        $ac_name=$acc['name'];

                                                        echo "<option value='$ac_id'>$ac_name </option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary" name="CreateItem">
                                                    <i class="fa fa-btn fa-sign-in"></i> Create Item
                                                </button>
                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">



            <div class="well">
                <h4>Accounts</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <?php
                            foreach($collectAccount as $account ){
                                $id=$account['id'];
                                $name=$account['name'];
                                $balance=$account['balance'];
                                $output=<<<OUTPUT
                                              <li><a href="accountsView.php?account=$id">$name</a><p>$balance</p>
                                </li>
OUTPUT;
                                echo($output);

                            }
                            ?>
                        </ul>
                        <div class="row"><p>Total Balance</p><p>
                                <?php
                                $total=null;
                                foreach($collectAccount as $account ){
                                    $balance=$account['balance'];
                                    $total=$total+$balance;
                                }

                                echo($total);
                                ?></p>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>


        </div>

    </div>

</div>



<script src="js/vendor/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body></html>
