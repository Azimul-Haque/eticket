
<?php 
    require("session.php");
    include('menu.php'); 
?>

<?php 
	if(isset($flag)){
        // codes starts here with a checking...
        if ($flag=="true") {
?>
<div class="container" style="margin-top:70px">
  	<div class="row">
  		<div class="col-md-6">
  			<h3 style="color: green;"><i class="fa fa-bus" aria-hidden="true"></i> Search Bus</h3>
  			<div class="panel panel-default">
  				<div class="panel-body">
  					<form action="" method="GET"> 
  						<div class="row">
                <div class="col-md-6">
                  <label for="from">From</label>
                  <select name="from" id="from" class="form-control" required="">
                    <option selected="" disabled="" value="">Select City</option>
                      <?php
                        $sql_select_city = "SELECT * FROM cities order by id asc";
                        $result = mysqli_query($conn, $sql_select_city);
                        if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                            $city_name = $row["city_name"];
                              echo "<option value='".$city_name."'>".$city_name."</option>";
                            }
                          }
                      ?>
                  </select>
                </div>  

                <div class="col-md-6">
                  <label for="to">To</label>
                  <select name="to" id="to" class="form-control" required="">
                    <option selected="" disabled="" value="">Select City</option>
                      <?php
                        $sql_select_city = "SELECT * FROM cities order by id asc";
                        $result = mysqli_query($conn, $sql_select_city);
                        if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                            $city_name = $row["city_name"];
                              echo "<option value='".$city_name."'>".$city_name."</option>";
                            }
                          }
                      ?>
                  </select>
                </div>      
              </div><br/>

  						<label for="date">Date of Travel</label>
  						<input type="text" name="date" id="date" class="form-control" required=""><br/>

              <button type="submit" name="search_bus" class="btn btn-block btn-warning"><i class="fa fa-search" aria-hidden="true"></i> Search Bus</button>
  					</form>
  				</div>
  			</div>
  		</div>

  		<div class="col-md-6">
  			<h3 style="color: blue;"><i class="fa fa-subway" aria-hidden="true"></i> Search Train</h3>
  			<div class="panel panel-default">
  				<div class="panel-body">
  					
  				</div>
  			</div>
  		</div>
  	</div>

    <div class="row">
      <div class="col-md-12">
        <?php
        if(isset($_GET['search_bus'])){
          $from = $_GET['from'];
          $to = $_GET['to'];
          $date = $_GET['date'].' 00:00:00';

          $sql_search_tickets = "SELECT * FROM tickets WHERE fromEntry='$from' AND toEntry='$to' AND dateEntry='$date'  order by id desc";
          $result = mysqli_query($conn, $sql_search_tickets);
          if (mysqli_num_rows($result) > 0) {
            echo "<h4 style='color: green; padding: 4px; background: #f0f4c3;'>".mysqli_num_rows($result)." trip(s) found!</h4>";
          ?>
        <div class="table-responsive">
            <table class="table table-striped ">
              <thead>
                <tr>
                    <th>Bus Name</th>
                    <th>From-To</th>
                    <th>Date-Time</th>
                    <th>Price</th>
                    <th>Availabel Seat(s)</th>
                    <th>Reserve</th>
                </tr>
              </thead>
              <tbody>
                <?php    
                  while($row = mysqli_fetch_assoc($result)) {
                    $bus_id = $row['id'];
                    $priceEntry = $row['priceEntry'];
                    $bus_name = $row['busEntry'];
                    $datetime_travel = date('F d, Y', strtotime($row['dateEntry'])).'-'.$row['timeEntry'];
                ?>
                <tr>
                  <td><?php echo $row['busEntry'];?></td>
                  <td><?php echo $row['fromEntry'].'-'.$row['toEntry'];?></td>
                  <td>
                    <?php echo date('F d, Y', strtotime($row['dateEntry'])).'-'.$row['timeEntry'];?>
                  </td>
                  <td><?php echo $row['priceEntry'].'/-';?></td>
                  <td><?php echo substr_count($row['seatEntry'], ',');?></td>
                  <td>
                    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#seatsbusno<?php echo $bus_id;?>" data-backdrop="static">Reserve Ticket</button>
                    <!-- Modal -->
                    <div class="modal fade" id="seatsbusno<?php echo $bus_id;?>" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title"><?php echo $row['busEntry'];?>, <?php echo $row['fromEntry'].'-'.$row['toEntry'];?>, <?php echo date('F d, Y', strtotime($row['dateEntry'])).'-'.$row['timeEntry'];?></h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6 text-center">
                                <p style="background: #f0f4c3; padding: 4px; border: 1px solid grey; width: 160px;">
                                <?php
                                  $seats = explode(',', $row['seatEntry']);
                                  $i=0;
                                  foreach($seats as $seat){
                                      $i++; 
                                      echo "<span style='width: 20px; height: 20px; background:lightgreen; border: 1px solid green; padding: 2px; margin: 6px;'>".$seat."</span>";
                                      if(($i%4==0) && !($i==40)) {
                                        echo '<br/><br/>';
                                      }
                                      
                                  }
                                ?>
                                </p>
                              </div>
                              <div class="col-md-6">
                                Select Seat<br/>
                                <form action="transaction.php" method="POST">
                                  <select name="seat_number" class="form-control" required="">
                                    <?php
                                      $seats = explode(',', $row['seatEntry']);
                                      foreach($seats as $seat){
                                        echo "
                                        <option value='".$seat."'>".$seat."</option>
                                        ";
                                      }
                                    ?>
                                  </select><br/>
                                  
                                  <input type="hidden" name="email" value="<?php echo $email;?>">
                                  <input type="hidden" name="price" value="<?php echo $priceEntry;?>">
                                  <input type="hidden" name="selected_bus_id" value="<?php echo $bus_id;?>">
                                  <input type="hidden" name="selected_bus_name" value="<?php echo $bus_name;?>">
                                  <input type="hidden" name="datetime_travel" value="<?php echo $datetime_travel;?>">

                                  <button type="submit" name="reserve_ticket" class="btn btn-block btn-warning">Reserve</button>
                                </form>
                                
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
        </div>
        <?php     
        } else {
                  echo "<h4 style='color: red; padding: 4px; background: #f0f4c3;'>No trips found!</h4>";
          }
                ?>
        <?php
      }
      ?>

                              

        <br/><br/><br/>
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

<?php include('footer.php'); ?>