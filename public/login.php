<?php

require"../vendor/autoload.php";

use App\Controllers\LoginController;


$errorList=[];
$alert=[];


if(isset($_POST['Login'])){
    $login=new LoginController();
    $errorList=$login->verifyValues($_POST['password'],$_POST['email']);


    if(empty($errorList)){
        $alert=$login->querying();
    }

}


?>



<!DOCTYPE html>
<html class="" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Budget Management Login</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/welcome.css">
<link rel="stylesheet" href="fonts.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/new_1.css">
<meta class="foundation-mq"></head>
<body>

<div class="containerr">
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

</div>

<!--creating profile section-->

<div class="main_profile_section">

  <!--Log In View-->
  <div class="row container" style="margin-top:150px">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="modal-title"></div>

            </div>
            <div class="panel panel-default">
                <?php
                foreach($errorList as $listerror) {
                    echo("<div class='alert-info'>" .$listerror."</div>");
                }
                foreach($alert as $information){
                    echo("<div class='alert-info'>".$information."</div>");
                }
                ?>



                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="">

                                                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="Login">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

<!--Footer starts here-->


<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/foundation.js"></script>
<script>
      $(document).foundation();
    </script>
<script type="text/javascript">
function openSidebar(){
  var sidebar=document.getElementById('leftSideBar1');
  sidebar.style.transform="translateX(0px)";
}

function closeSidebar(){
  var sidebar=document.getElementById('leftSideBar1');
  sidebar.style.transform="translateX(-300px)";
}

</script>

</body></html>
