


<?php 
    require("session.php");
    include('menu.php'); 
?>

<?php 
	if(isset($flag)){
        // codes starts here with a checking...
        if ($flag=="true") {
?>
  <style type="text/css">
     @media print {
      body * {
        visibility: hidden;
      }
      #forPrintPurpose, #forPrintPurpose * {
        visibility: visible;
      }
      #printButton{
        visibility: hidden;
      }
      #forPrintPurpose {
        position: relative;
        /* left: 0;
        top: 0; */
      }
      a:link:after, a:visited:after {
        content: '' !important;
      }
    } 
  </style>
<div class="container" style="margin-top:70px">
  <div class="row">
    <div class="col-md-6">
      <?php
                                if(isset($_POST['reserve_ticket'])) {  
                                  $seat_number = $_POST['seat_number'];
                                  $email = $_POST['email'];
                                  $price = $_POST['price'];
                                  $selected_bus_id = $_POST['selected_bus_id'];
                                  $selected_bus_name = $_POST['selected_bus_name'];
                                  $datetime_travel = $_POST['datetime_travel'];
                                  $reservation_id = $seat_number.substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(4/strlen($x)) )),1,4).$selected_bus_id;

                                  $sql_reserve_ticket = "INSERT INTO reserved (seat_number, email, selected_bus_id, selected_bus_name, datetime_travel, reservation_id) VALUES ('$seat_number', '$email', '$selected_bus_id', '$selected_bus_name', '$datetime_travel', '$reservation_id')";

                                  if (mysqli_query($conn, $sql_reserve_ticket)) {
                                      echo "<h4 style='background: #f0f4c3; padding: 4px;'>Reserved successfully! <br/>Reservation Id: ".$reservation_id."</h4>";
                                      echo "Please Pay Tk. ".$price." to the number 01711001100 via BKash and submit the transaction id to the form below. <br/><br/>";
                                  } else {
                                      echo "Error: " . $sql_reserve_ticket . "<br>" . mysqli_error($conn) . "<br/>";
                                      
                                  }
                                } else {
                                  echo '';
                                }
                              ?>
      
      <div class="row">
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-body">
              <form action="" method="POST">
                <label for="transaction_id">Reservtion Id</label>
                <input type="text" id="transaction_id" name="reservation_id" class="form-control" required="" placeholder="Reservation Id">
                <br/>
                <label for="transaction_id">Transaction Id</label>
                <input type="text" id="transaction_id" name="transaction_id" class="form-control" required="" placeholder="Transaction Id">
                <br/>

                <button type="submit" class="btn btn-block btn-success" name="confirm_ticket">Submit and Get the Ticket</button>
              </form>

            </div>
          </div>

              
        </div>
      </div>
      <?php
                if(isset($_POST['confirm_ticket'])) {

                  $reservation_id_confirm = $_POST['reservation_id'];
                  $seat_number = substr($reservation_id_confirm, 0, 2).',';
                  $bus_id = substr($reservation_id_confirm, -1);
                    
                  $sql_confirm_ticket = "UPDATE reserved SET ticket_print = 1 WHERE reservation_id = '$reservation_id_confirm'";

                  if (mysqli_query($conn, $sql_confirm_ticket)) {
                      echo "<h4 style='background: #f0f4c3; padding: 4px;'>Confirmed successfully! <br/>Reservation Id: ".$reservation_id_confirm."</h4>";

                      // ticket deallocation
                      $sql_ticket_deallocation = "UPDATE tickets SET seatEntry=REPLACE(seatEntry, '$seat_number', '') WHERE id = '$bus_id'";
                      if (mysqli_query($conn, $sql_ticket_deallocation)) {
                          echo "Deallocation updated successfully";
                      } else {
                          echo "Error updating record: " . mysqli_error($conn);
                      }
                      // ticket allocation

                      // print ticket
                      $sql_ticket_print = "SELECT * FROM reserved WHERE reservation_id = '$reservation_id_confirm' AND ticket_print = 1";
                      $result = mysqli_query($conn, $sql_ticket_print);
                      if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) { 
                          ?>
              <div class="panel panel-default print_it" id="forPrintPurpose">
                <div class="panel-body">
                  <button class="btn btn-primary btn-xs" id="printButton" style="float: right;">Print Ticket</button><br/><br/>
                  <span style="float: left;">Customer Email: <?php echo $row['email'];?></span>
                  <span style="float: right;">Reservation Id: <?php echo $row['reservation_id'];?></span>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Bus Name</th>
                        <th>Seat Number</th>
                        <th>Date-Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $row['selected_bus_name'];?></td>
                        <td><?php echo $row['seat_number'];?></td>
                        <td><?php echo $row['datetime_travel'];?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>


                          <?php
                          } 
                      }
                      // print ticket

                  } else {
                      echo "Error: " . $sql_confirm_ticket . "<br>" . mysqli_error($conn) . "<br/>";
                  }

                }
              ?>
    </div>

    <div class="col-md-6">
      <h4>Your resereved Tickets</h4>
      <div class="table-responsive">
                  <table class="table table-striped table-condensed table-bordered ticket-table">
                    <thead>
                      <tr>
                        <th>Date-Time</th>
                        <th>Seat Number</th>
                        <th>Reservation Id</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql_read_reservations = "SELECT * FROM reserved WHERE email = '$email' order by id desc";
                        $result = mysqli_query($conn, $sql_read_reservations);
                        if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                      ?>
                  <tr>
                    <td><?php echo $row['datetime_travel'];?></td>
                    <td><?php echo $row['seat_number'];?></td>
                    <td><?php echo $row['reservation_id'];?></td>
                    <td>
                      <?php 
                        if($row['ticket_print'] == 1) {
                          echo 'purchased';
                        } else{
                          echo 'Not purchased'; 
                        }
                      ?>
                    </td>
                  </tr> 
                  <?php     
                      }
                    }
                      ?>
                    </tbody>
                  </table>
                </div>
    </div>
  </div>
</div>

<?php 
		}else {
?>
	<div class="container" style="margin-top:70px">
	  	<div class="row">
	  		<div class="col-md-4 col-md-offset-4 text-center">
	  			<p>You need to be logged-in to access this page!</p> <br/>  
	  			<a href="register.php" class="btn btn-primary btn-lg"><i class="fa fa-plus-square" aria-hidden="true"></i> Register</a>
	  				 or 
	  			<a href="login.php" class="btn btn-success btn-lg"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</a>
	  		</div>
	  	</div>
	</div>
<?php
		}
	} else {
?>
	<div class="container" style="margin-top:70px">
	  	<div class="row">
	  		<div class="col-md-4 col-md-offset-4 text-center">
	  			<p>You need to be logged-in to access this page!</p> <br/> 
	  			<a href="register.php" class="btn btn-primary btn-lg"><i class="fa fa-plus-square" aria-hidden="true"></i> Register</a>
	  				 or 
	  			<a href="login.php" class="btn btn-success btn-lg"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</a>
				
	  		</div>
	  	</div>
	</div>

<?php
	}
?>

<script>
      $(function() {
        $('#date').datepicker({
              dateFormat: 'yy-mm-dd',
              onSelect: function(datetext){
                  var d = new Date(); // for now
                  var h = "00";

                  var m = "00";

                  var s = "00";

                  datetext = datetext;
                  $('#date').val(datetext);
              },
          });
      }); 
  </script>
  <script type="text/javascript">
    $("#printButton").click(function () {
        //Hide all other elements other than printarea.
        $("#forPrintPurpose").show();
        window.print();
    });
  </script>

<?php include('footer.php'); ?>