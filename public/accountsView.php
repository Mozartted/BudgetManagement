<?php
include "../app/Controllers/SessionController.php";
use App\Controllers\SessionController;
use App\Model\Budget;
use App\Model\Account;
use App\Model\Transaction;

require_once '../vendor/autoload.php';

$session=SessionController::checkSessionKey();


if($session==$_GET['key']){

}else{
    header("Location:login.php");
}
$accountId=$_GET['account'];

$account=(new Account())->getAccount($accountId);

//getting all in budget
$budgetList=Budget::getAllBudget();
$collectAccount=Account::getAllAccount();
$transactions=Transaction::getAllTransactionsAccount($accountId);

?>


<!DOCTYPE html>
<html class="" lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Management</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <meta class="foundation-mq"></head>
<body>
<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div>
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
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo($account['name'])?>
                <small><?php echo($account['balance'])?></small>
            </h1>
            <div class="row">
                <p>
                    <?php echo($account['describ'])?>
                </p>
            </div>
        </div>
    </div>

<!--creating profile section-->
<div class="container">
    <div class="row" style="margin-top:50px;">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <div id="generalTabContent" class="tab-content responsive">
                <div id="alert-tab" class="tab-pane fade in active">
                    <div class="row">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            Transactions</h3>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <a href="editTransaction.php" class="btn btn-primary">
                                                        <i class="fa fa-btn fa-sign-in"></i> Create Transaction
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-group">
                                        <?php
                                        foreach($transactions as $transact ){
                                            $id=$transact['id'];
                                            $name=$transact['name'];
                                            $amount=$transact['amount'];
                                            $date=$transact['date'];
                                            $type="";
                                            if($transact['type']==1){
                                                $type="Income";
                                            }else if($transact['type']==0){
                                                $type="Expense";
                                            }

                                            $output=<<<OUTPUT
                                                        <li class=" list-group-item col-md-6">
                                                        <a href="budgetview.php?budget=$id">
                                                                $name
                                                        </a>
                                                        </li>
                                                            <li class="list-group-item col-md-6">
                                                            <p>$type</p>
                                                            <div class="col-md-3">$amount</div><div class="col-md-3">
                                                               <a href="http://localhost:8000/administrator/user/$id/edit" class="btn btn-success">Edit</a>
                                                                  </br>
                                                                  <form method="POST" action="http://localhost:8000/administrator/user/?delete=$id" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="Tb1joOhAxBhrqAhPk45HfAWgYbTRoNfbqjRD4P5y">
                                                                      <input class="btn btn-danger" type="submit" value="Delete">
                                                                  </form>
                                                            </div>

                                                        </li>
OUTPUT;
                                            echo($output);

                                        }
                                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

</div>
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Admin</h4>
                <div class="input-group">
                    <div><img src="" style="width:25px; height:25px"></div>
                </div>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <div>

                <div class="well">
                    <h4>Budgets</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php
                                foreach($budgetList as $budget ){
                                    $id=$budget['id'];
                                    $name=$budget['name'];
                                    $balance=$budget['balance'];
                                    $output=<<<OUTPUT
                                              <li><a href="budgetview.php?budget=$id">$name</a><p>$balance</p>
                                </li>
OUTPUT;
                                    echo($output);

                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
    </div>

<div>

<script src="js/vendor/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body></html>