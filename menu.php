<?php 
  require("config.php");
  date_default_timezone_set('Asia/Dhaka');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Ticket System</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/parsley.css">
  <link rel="stylesheet" href="css/dtpui.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />
  <script src="bootstrap/js/jquery-3.1.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/scripts.js"></script>
  <script src="js/dtpui.js"></script>
  <script src="js/parsley.min.js"></script>
  <script type="text/javascript" src="js/jquery.timepicker.js"></script>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">E-Ticket</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/eticket"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> About</a></li>
        <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Contact</a></li>
        <li><a href="booking.php"><i class="fa fa-bookmark" aria-hidden="true"></i> Book Now</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
            <?php
                if(isset($flag)){
                    // codes starts here with a checking...
                  if ($flag=="true") {
                    if($role == 'admin'){
                      echo '
                        <li><a href="admin.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                      ';
                    } elseif($role == 'manager'){
                      echo '
                        <li><a href="manager.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                      ';
                    }elseif($role == 'customer'){
                      echo '
                        <li><a href="transaction.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Reservation</a></li>
                      ';
                    } else{
                      
                    }
                    
                    echo '
                    <li><a href="#!"><span class="glyphicon glyphicon-user"></span> '.$email.'</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                      ';
                  } elseif($flag=="false") {
                    
                    echo '
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                  }  
                    
                } else {
                    echo '
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                }
            ?>
        
      </ul>
    </div>
  </div>
</nav>
  






