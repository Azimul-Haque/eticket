

<?php 
    require("session.php");
    include('menu.php'); 
?>

<div class="container" style="margin-top:70px">
  	<div class="row">
        <div class="">
          <?php include('slider.php');?>  
        </div><br/>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
                <div class="avatar">
                    <span class="bigicons"><i class="fa fa-bus header-bus" aria-hidden="true"></i></span>
                </div>
                <div class="content">
                    <p><b>Bus</b> <br>
                       Tickets are available here</p>
                    <p><a href="booking.php" class="btn btn-default">Book Now!</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
                <div class="avatar">
                    <span class="bigicons"><i class="fa fa-subway header-subway" aria-hidden="true"></i></span>
                </div>
                <div class="content">
                    <p><b>Train</b> <br>
                       Tickets are available here</p>
                    <p><a href="booking.php" class="btn btn-default">Book Now!</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
                <div class="avatar">
                    <span class="bigicons"><i class="fa fa-ticket header-ticket" aria-hidden="true"></i></span>
                </div>
                <div class="content">
                    <p><b>Event</b> <br>
                       Tickets are available here</p>
                    <p><a href="booking.php" class="btn btn-default">Book Now!</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <dir class="col-md-12">
            
        </dir>
    </div>
</div>




<?php include('footer.php'); ?>