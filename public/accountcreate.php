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
            <h1 class="page-header">Create Account
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
                                        <div class="panel-heading" style="color:#202020;">Create Account</div>
                                        <div class="panel-body">
                                            <!--Displays the users and their levels Admin or writer-->

                                            <div>
                                              <form class="form-horizontal" role="form" method="POST" action="../app/Controllers/createAccount.php">
                                                  <div class="form-group">
                                                      <label for="name" class="col-md-4 control-label">Account Name</label>

                                                      <div class="col-md-6">
                                                          <input  class="form-control" name="name" value="">
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label for="balance" class="col-md-4 control-label">Opening Balance</label>

                                                      <div class="col-md-6">
                                                          <input  type="number" class="form-control" name="balance">

                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label for="describ" class="col-md-4 control-label">Description</label>

                                                      <div class="col-md-6">
                                                          <textarea  type="text" class="form-control" name="describ"></textarea>

                                                      </div>
                                                  </div>



                                                  <div class="form-group">
                                                      <label for="password" class="col-md-4 control-label">Account Type</label>

                                                        <div class="col-md-6">
                                                              <select  type="number" class="form-control" name="type">
                                                                <?php
                                                                    foreach($accountType as $type){
                                                                        $id=$type['id'];
                                                                        $name=$type['name'];
                                                                        $option=<<<OPTION
                                                                        <option value="$id">$name</option>
OPTION;
                                                                        echo($option);

                                                                    }
                                                                ?>
                                                              </select>
                                                        </div>
                                                  </div>



                                                  <div class="form-group">
                                                      <div class="col-md-6 col-md-offset-4">
                                                          <button type="submit" class="btn btn-primary" name="createAccount">
                                                              <i class="fa fa-btn fa-sign-in"></i> Create Account
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
                                <li><a href="#">Account Names</a>
                                </li>
                                <li><a href="#">Account Names2</a>
                                </li>
                                <li><a href="#">Others</a>
                                </li>
                                <li><a href="#">Domilcilary</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
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