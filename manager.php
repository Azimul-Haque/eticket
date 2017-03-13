

<?php 
    require("session.php");
    include('menu.php'); 
?>

<?php
    if(isset($flag)){
                    // codes starts here with a checking...
        if ($flag=="true") {
            if($role == 'admin' || $role == 'manager'){
              
?>
	<div class="container-fluid" style="margin-top:70px">
	  	<div class="row">
	  		<div class="col-md-2">
	  			<div class="row">
	              <div class="btn-group-vertical col-md-12">
	                <button type="button" class="btn btn-info btn-block"><i class="fa fa-lock" aria-hidden="true"></i> Manager Dashboard</button>
	                <?php
	                if($role == 'admin') {
	                ?>
	                <a type="button" class="btn btn-default btngroup btn-block" href="admin.php"><i class="fa fa-clipboard" aria-hidden="true"></i> Role Change</a>
	                <?php
	                }
	                ?>

	                <a type="button" class="btn btn-default btngroup btn-block" href="manager.php"><i class="fa fa-list-ol" aria-hidden="true"></i> Ticket Entry</a>

	                <a type="button" class="btn btn-default btngroup btn-block" href="login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> <b>Logout</b></a>
	                <br/>
	              </div>
	            </div>
	  		</div>
	  		<div class="col-md-10">
	  			<div class="row">
			  		<div class="col-md-12">
					      <div class="row">
					      	<div class="col-md-5">
					      		<h4>Bus Schedules</h4>
					      		<div class="table-responsive">
					      			<table class="table table-striped table-condensed table-bordered ticket-table">
					      				<thead>
					      					<tr>
					      						<th>Bus Name</th>
					      						<th>From-To</th>
					      						<th>Date-Time</th>
					      						<th>Price</th>
					      					</tr>
					      				</thead>
					      				<tbody>
					      					<?php
					      						$sql_read_tickets = "SELECT * FROM tickets order by id desc";
												$result = mysqli_query($conn, $sql_read_tickets);
												if (mysqli_num_rows($result) > 0) {
													while($row = mysqli_fetch_assoc($result)) {
											?>
											<tr>
												<td><?php echo $row['busEntry'];?></td>
												<td><?php echo $row['fromEntry'].'-'.$row['toEntry'];?></td>
												<td>
													<?php echo date('F d, Y', strtotime($row['dateEntry'])).'-'.$row['timeEntry'];?>
												</td>
												<td><?php echo $row['priceEntry'].'/-';?></td>
											</tr>	
											<?php			
													}
												}
					      					?>
					      				</tbody>
					      			</table>
					      		</div>
					      	</div>
					      	<div class="col-md-4">
					      		<h4>New Ticket</h4>
					      		<div class="panel panel-default">
					      			<div class="panel-body">
						      		<form method="POST" action="">
						      			<div class="row">
						      				<div class="col-md-6">
						      					<label for="fromEntry">From</label>
									      			<select name="fromEntry" id="fromEntry" class="form-control" required="">
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
						      					<label for="toEntry">To</label>
									      			<select name="toEntry" id="toEntry" class="form-control" required="">
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

						      			<label for="busEntry">Bus Name</label>
						      			<select name="busEntry" id="busEntry" class="form-control" required="">
											<option selected="" disabled="" value="">Select Bus</option>
									      		<?php
									      			$sql_select_bus = "SELECT * FROM buses order by id asc";
													$result = mysqli_query($conn, $sql_select_bus);
													if (mysqli_num_rows($result) > 0) {
													    while($row = mysqli_fetch_assoc($result)) {
													    	$bus_name = $row["bus_name"];
															echo "<option value='".$bus_name."'>".$bus_name."</option>";
														}
													}
									      		?>
									    </select><br/>

						      			<div class="row">
						      				<div class="col-md-6">
						      					<label for="dateEntry">Date of Travel</label>
						      					<input type="text" name="dateEntry" id="dateEntry" class="form-control" required="" placeholder="Enter Date">
						      				</div>
						      				<div class="col-md-6">
						      					<label for="timeEntry">Time of Travel</label>
						      					<input type="text" name="timeEntry" id="timeEntry" class="form-control" required="" placeholder="Enter Time">
						      				</div>
						      			</div>
						      			<br/>

						      			<div class="row">
						      				<div class="col-md-6">
						      					<label for="seatEntry">Total Seat</label>
						      					<input type="text" name="seatEntry" id="seatEntry" class="form-control" required="" value="40" disabled="">
						      				</div>
						      				<div class="col-md-6">
						      					<label for="priceEntry">Price (Tk.)</label>
						      					<input type="text" name="priceEntry" id="priceEntry" class="form-control" required="" placeholder="Enter Price">
						      				</div>
						      			</div><br/>

						      			<button type="submit" class="btn btn-block btn-primary" name="add_new_ticket">Add Ticket</button>
						      			
						      		</form>
						      		<?php
							      		if(isset($_POST['add_new_ticket'])) {
								      		$fromEntry = $_POST['fromEntry'];	
								      		$toEntry = $_POST['toEntry'];	
								      		$busEntry = $_POST['busEntry'];	
								      		$dateEntry = $_POST['dateEntry'];	
								      		$timeEntry = $_POST['timeEntry'];	
								      		$seatEntry = 'A1,A2,A3,A4,B1,B2,B3,B4,C1,C2,C3,C4,D1,D1,D1,D1,E1,E2,E3,E4,F1,F2,F3,F4,G1,G2,G3,G4,H1,H2,H3,H4,I1,I2,I3,I4,J1,J2,J3,J4,';	
								      		$priceEntry = $_POST['priceEntry'];	
								      		$created_at = date("Y-m-d H:i:s");

								      		$sql_add_ticket = "INSERT INTO tickets (fromEntry, toEntry, busEntry, dateEntry, timeEntry, seatEntry, priceEntry, created_at) VALUES ('$fromEntry', '$toEntry', '$busEntry', '$dateEntry', '$timeEntry', '$seatEntry', '$priceEntry', '$created_at')";

											if (mysqli_query($conn, $sql_add_ticket)) {
												echo "<p style='background: lightgreen; padding: 4px;'>Added!</p>";
											    echo "<script>setTimeout(function(){ window.location.href = 'manager.php'; }, 1500);</script>";
											} else {
											    echo "Error: " . $sql_add_ticket . "<br>" . mysqli_error($conn);
											}
								      	}
						      		?>
						      		</div>
						      	</div>	
					      	</div>
					      	<div class="col-md-3">
					      		<h4>Add City</h4>
					      		<div class="panel panel-default">
					      			<div class="panel-body">
							      		<form method="POST" action="">
							      			<input type="text" name="city_name" placeholder="Enter New City" required="" class="form-control"><br/>
							      			<button type="submit" name="add_new_city" class="btn btn-block btn-success">Add New City</button>
							      		</form>
							      		<?php
							      			if(isset($_POST['add_new_city'])) {
							      				$city_name = $_POST['city_name'];	

							      				$sql_add_city = "INSERT INTO cities (city_name) VALUES ('$city_name')";

												if (mysqli_query($conn, $sql_add_city)) {
												    echo "<p style='background: lightgreen; padding: 4px;'>Added!</p>";
												} else {
												    echo "Error: " . $sql_add_city . "<br>" . mysqli_error($conn);
												}
							      			}
							      		?>
					      			</div>
					      		</div><br/>

					      		<h4>Add Bus Company</h4>
					      		<div class="panel panel-default">
					      			<div class="panel-body">
							      		<form method="POST" action="">
							      			<input type="text" name="bus_name" placeholder="Enter New Bus" required="" class="form-control"><br/>
							      			<button type="submit" name="add_new_bus" class="btn btn-block btn-success">Add New Bus</button>
							      		</form>
							      		<?php
							      			if(isset($_POST['add_new_bus'])) {
							      				$bus_name = $_POST['bus_name'];	

							      				$sql_add_bus = "INSERT INTO buses (bus_name) VALUES ('$bus_name')";

												if (mysqli_query($conn, $sql_add_bus)) {
												    echo "<p style='background: lightgreen; padding: 4px;'>Added!</p>";
												} else {
												    echo "Error: " . $sql_add_bus . "<br>" . mysqli_error($conn);
												}
							      			}
							      		?>
					      			</div>
					      		</div>
					      	</div>
					      </div>

			  		</div>
			  	</div>
	  		</div>
	  	</div>
	</div>
<?php              
        	} else {
?>
	<div class="container" style="margin-top:70px">
	  	<div class="row">
	  		<div class="col-md-12 text-center">
	  			<h3 style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: red;"></i> 403 Forbidden</h3>
				<p>You do not have permission to access this page!</p>
	  		</div>
	  	</div>
	</div>
<?php
        	}
                
        } else {
  
?>
	<div class="container" style="margin-top:70px">
	  	<div class="row">
	  		<div class="col-md-12 text-center">
	  			<h3 style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: red;"></i> 403 Forbidden</h3>
				<p>You do not have permission to access this page!</p>
	  		</div>
	  	</div>
	</div>
<?php            

        }  
                    
    } else {
?>
	<div class="container" style="margin-top:70px">
	  	<div class="row">
	  		<div class="col-md-12">
	  			<h3 style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: red;"></i> 403 Forbidden</h3>
				<p>You do not have permission to access this page!</p>
	  		</div>
	  	</div>
	</div>
<?php         
    }
?>



<script>
	  $('#timeEntry').timepicker();
      $(function() {
        $('#dateEntry').datepicker({
              dateFormat: 'yy-mm-dd',
              onSelect: function(datetext){
                  var d = new Date(); // for now
                  var h = "00";

                  var m = "00";

                  var s = "00";

                  datetext = datetext + " " + h + ":" + m + ":" + s;
                  $('#dateEntry').val(datetext);
              },
          });
      });


  </script>




<?php include('footer.php'); ?>