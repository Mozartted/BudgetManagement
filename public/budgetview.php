<?php
include "../app/Controllers/SessionController.php";
use App\Controllers\SessionController;
use App\Model\Items;
use App\Model\Account;
use App\Model\Budget;
require_once '../vendor/autoload.php';

$session=SessionController::checkSessionKey();


if($session==$_GET['key']){

}else{

}

$budget_id=$_GET['budget'];
$budgetInfo=(new Budget())->getBudget($budget_id);


//getting all in budget
$itemList=Items::getAllItemsInBudget($budget_id);
$collectAccount=Account::getAllAccount();

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
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!--creating profile section-->
<div class="container">
    <div class="row" style="margin-top:50px;">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <div id="generalTabContent" class="tab-content responsive">
                <div id="alert-tab" class="tab-pane fade in active">
                    <div class="row">
                        <div>
                            <div class="panel-heading"><?php echo($budgetInfo['name']) ?></div>
                            <div class="row"><p>Totaling</p><p>
                                    <?php
                                    $total=null;
                                    foreach($itemList as $itemm ){
                                        $balance=$itemm['amount'];
                                        $total=$total+$balance;
                                    }

                                    echo($total);
                                    ?></p>
                            </div>
                            <div class="panel-body">
                                <!--Displays the users and their levels Admin or writer-->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            Items</h3>
                                    </div>
                                    <ul class="list-group">
                                    <?php
                                    foreach($itemList as $item ){
                                        $id=$item['id'];
                                        $name=$item['name'];
                                        $amount=$item['amount'];

                                        $output=<<<OUTPUT
                                                          <div class="list-group-item row">
                                                        <div class="col-md-6">
                                                        <a href="budgetview.php?budget=$id">
                                                                $name
                                                        </a>
                                                        </div>
                                                            <div class="col-md-6">
                                                                <div class="col-md-3">$amount</div><div class="col-md-3">
                                                                    <a href="http://localhost:8000/administrator/user/$id/edit" class="btn btn-success">Edit</a>
                                                                    <form method="POST" action="http://localhost:8000/administrator/user/?delete=$id" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="Tb1joOhAxBhrqAhPk45HfAWgYbTRoNfbqjRD4P5y">
                                                                        <input class="btn btn-danger" type="submit" value="Delete">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
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
                </div>
            </div>
        <!-- Blog Sidebar Widgets Column -->
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

            <!-- Side Widget Well -->
            <div class="well">
                <h4>Side Widget Well</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
            </div>

        </div>
    </div>

</div>




<script src="js/vendor/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body></html>
