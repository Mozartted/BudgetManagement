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

$trans=$_GET['transaction'];

$TransInfo=\App\Model\Transaction::getTransact($trans);

//getting all in budget
$budgetList=Budget::getAllBudget();
$collectAccount=Account::getAllAccount();
$transactions=Transaction::getAllTransactionsAccount($accountId);

session_start();
$errorList=$_SESSION['errorList'];

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
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div>
                            <form method="POST" action="../app/Controllers/createAccount.php" accept-charset="UTF-8">
                                <input class="btn btn-success" type="submit" name="logout" value="Logout">
                            </form>
                        </div>
                    </li>
                </ul>
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
            <h1 class="page-header">Create Transaction
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
                            <div class="panel-heading" style="color:#202020;">Create Transaction</div>
                            <div class="panel-body">
                                <?php
                                foreach($errorList as $listerror) {
                                    echo("<div class='alert-info'>" .$listerror."</div>");
                                }
                                ?>
                                <!--Displays the users and their levels Admin or writer-->

                                <div>
                                    <form class="form-horizontal" role="form" method="POST" action="../app/Controllers/createAccount.php?transaction=<?php echo $trans?>">
                                        <div class="form-group">
                                            <label for="name" class="col-md-4 control-label">Name</label>

                                            <div class="col-md-6">
                                                <input  class="form-control" name="name" value="<?php echo $TransInfo['name']?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="balance" class="col-md-4 control-label">Transaction Amount</label>

                                            <div class="col-md-6">
                                                <input  type="number" class="form-control" name="amount" value="<?php echo $TransInfo['amount']?>">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="describ" class="col-md-4 control-label">Description</label>

                                            <div class="col-md-6">
                                                <textarea  type="text" class="form-control" name="describ"><?php echo $TransInfo['description']?></textarea>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="date" class="col-md-4 control-label">Transaction Date</label>

                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="date" value="<?php echo $TransInfo['datee']?>">
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="password" class="col-md-4 control-label">Transaction Type</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="type">
                                                    <option value="1">SELECT TRANSACTION TYPE</option>
                                                    <option value="1">Expenses</option>
                                                    <option value="2">Income</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="col-md-4 control-label">Select Account</label>

                                            <div class="col-md-6">
                                                <select  class="form-control" name="account">
                                                    <?php
                                                    foreach($account as $acc){
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
                                                <button type="submit" class="btn btn-primary" name="UpdateTransaction">
                                                    <i class="fa fa-btn fa-sign-in"></i> Update Transaction
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



            <!-- Blog Categories Well -->
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
                    </div>
                    <!-- /.col-lg-6 -->
                    <p>Total</p>
                    <?php
                    $total=null;
                    foreach($collectAccount as $account ){
                        $balance=$account['balance'];
                        $total=$total+$balance;
                    }

                    echo($total);
                    ?>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
            </div>



        </div>

    </div>

</div>



<script src="js/vendor/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body></html>
*/