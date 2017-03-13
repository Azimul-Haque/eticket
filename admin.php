

<?php 
    require("session.php");
    include('menu.php'); 
?> 

<?php
    if(isset($flag)){
                    // codes starts here with a checking...
        if ($flag=="true") {
            if($role == 'admin'){
              
?>
	<div class="container-fluid" style="margin-top:70px">
	  	<div class="row">
	  		<div class="col-md-2">
	  			<div class="row">
	              <div class="btn-group-vertical col-md-12">
	                <button type="button" class="btn btn-info btn-block"><i class="fa fa-lock" aria-hidden="true"></i> Admin Dashboard</button>
	                <a type="button" class="btn btn-default btngroup btn-block" href="admin.php"><i class="fa fa-clipboard" aria-hidden="true"></i> Role Change</a>

	                <a type="button" class="btn btn-default btngroup btn-block" href="manager.php"><i class="fa fa-list-ol" aria-hidden="true"></i> Ticket Entry</a>

	                <a type="button" class="btn btn-default btngroup btn-block" href="login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> <b>Logout</b></a>
	                <br/>
	              </div>
	            </div>
	  		</div>
	  		<div class="col-md-10">
	  			<div class="row">
	  				<div class="col-md-8">
	  					<span style="color: green; font-size: 25px;">User list</span>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-condensed">
								<thead>
									<tr>
										<th>Email</th>
										<th>Role</th>
										<th>Created At</th>
										<th><i class="fa fa-pencil-square-o" aria-hidden="true"></i></th>
										<th><i class="fa fa-trash-o" aria-hidden="true"></i></th>
									</tr>
								</thead>
								<tbody>
								<?php
								if($conn) {
									$sql = "SELECT * FROM users order by id asc";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {
									    // output data of each row
									    while($row = mysqli_fetch_assoc($result)) {
									        // print the users on below table
									?>
									<tr>
										<td><?php echo $row["email"];?></td>
										<form action="" method="POST">
										<td>
											<span id="roleSpan<?php echo $row['id'];?>" ><?php echo $row["role"];?></span>
											<select name="role" required="" class="form-control" id="roleSelect<?php echo $row['id'];?>" >
												<option selected="" disabled="" value="">Select a Role</option>
												<option value="admin">Admin</option>
												<option value="manager">Manager</option>
												<option value="customer">Customer</option>
											</select>
										</td>
										<td><?php echo date("F d, Y", strtotime($row["created_at"]));?></td>
										<td>
											<button class="btn btn-primary btn-xs" id="editBtn<?php echo $row['id'];?>"  >Edit</button>
											<button type="submit" name="submitRole<?php echo $row['id'];?>" class="btn btn-success btn-xs" id="saveBtn<?php echo $row['id'];?>"  >Save</button>
										</td>
										</form>
										<form action="" method="POST">
										<td>
											<span class="btn btn-warning btn-xs" id="deleteBtn<?php echo $row['id'];?>" type="">Delete</span>

											<input type="submit" class="btn btn-danger btn-xs" name="delete<?php echo $row['id'];?>" id="delete<?php echo $row['id'];?>" value="Confirm Delete?">
										</td>
										</form>
										<script type="text/javascript">
											$(document).ready(function(){
											    	$("#roleSelect<?php echo $row['id'];?>").hide();
											    	$("#saveBtn<?php echo $row['id'];?>").hide();
											    	$("#delete<?php echo $row['id'];?>").hide();

											    	$("#editBtn<?php echo $row['id'];?>").click(function(){
												       $("#roleSpan<?php echo $row['id'];?>").css({ display: 'none !important;', visibility: 'hidden !important;' }).hide();
												        $("#roleSpan<?php echo $row['id'];?>").hide();
												        $("#roleSelect<?php echo $row['id'];?>").show();
												        $("#saveBtn<?php echo $row['id'];?>").show();
												        $("#editBtn<?php echo $row['id'];?>").hide();
												    });
												    $("#deleteBtn<?php echo $row['id'];?>").click(function(){
												        $("#delete<?php echo $row['id'];?>").show();
												        $("#deleteBtn<?php echo $row['id'];?>").hide();
												        
												    });
											});
										</script>
									<!--php code to update the role-->
									<?php

										$submit = 'submitRole'.$row['id'];
										if(isset($_POST[$submit])){
											$role_to_update = $_POST['role'];
											$id_to_update = $row['id'];

											$sql_to_update_role = "UPDATE users SET role='$role_to_update' WHERE id='$id_to_update'";

											if (mysqli_query($conn, $sql_to_update_role)) {
											    echo "<h4 style='background: yellow; padding: 5px;'>Updated! Reloading the page now...</h4>";
											    echo '<script>setTimeout(function(){ window.location.href = "admin.php"; }, 1500);</script>';
											} else {
											    echo "Error updating record: " . mysqli_error($conn);
											}
										}

										$delete = 'delete'.$row['id'];
										if(isset($_POST[$delete])){
											$id_to_delete = $row['id'];

											$sql_to_delete = "DELETE FROM users WHERE id='$id_to_delete'";

											if (mysqli_query($conn, $sql_to_delete)) {
											    echo "<h4 style='background: lightgreen; padding: 5px;'>DELETED! Reloading the page now...</h4>";
											    echo '<script>setTimeout(function(){ window.location.href = "admin.php"; }, 1500);</script>';
											} else {
											    echo "Error deleting record: " . mysqli_error($conn);
											}
										}
									?>
									<!--php code to update the role-->
									</tr>
									<?php
									    }
									} else {
									    echo "0 results";
									}
								}
								?>
								</tbody>
							</table>
						</div>
	  				</div>
	  				<div class="col-md-4">
	  					<span style="color: green; font-size: 25px;">Add a user</span>
	  					<div class="panel panel-default">
	  						<div class="panel-body">
	  							<form action="" method="POST" data-parsley-validate="">
			  						<input type="text" name="username" class="form-control" placeholder="Username" required=""><br/>
			  						<input type="text" name="email" class="form-control" placeholder="Email" required=""><br/>
			  						<select name="role" class="form-control" required="">
			  							<option selected="" disabled="" value="">Select a Role</option>
			  							<option value="admin">Admin</option>
			  							<option value="manager">Manager</option>
			  							<option value="customer">Customer</option>
			  						</select><br/>
			  						<input type="password" name="password" id="password" class="form-control" placeholder="Password" required=""><br/>
			  						<input type="password" name="password-confirm" placeholder="Confirm Password" data-parsley-equalto="#password" class="form-control" required=""><br/>
			  						<button class="btn btn-info btn-block" type="submit" name="addNewUser">Add new user</button>
			  					</form>

			  				<?php
							if(isset($_POST['addNewUser'])) {
								$username = $_POST['username'];
								$email = $_POST['email'];
								$role = $_POST['role'];
								$password = $_POST['password'];
								$created_at = date("Y-m-d H:i:s");
								$updated_at = date("Y-m-d H:i:s");

								$sql_add_new_user = "INSERT INTO users (username, email, password, role, created_at, updated_at)
								VALUES ('$username', '$email', '$password', '$role', '$created_at', '$updated_at')";

								if (mysqli_query($conn, $sql_add_new_user)) {
								    echo "<h4 style='background: lightgreen; padding: 5px;'>Added! Reloading the page now...</h4>";
									echo '<script>setTimeout(function(){ window.location.href = "admin.php"; }, 1500);</script>';
								} else {
								    echo "Error: " . $sql_add_new_user . "<br>" . mysqli_error($conn);
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
                
        } else{
  
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
?>




<?php include('footer.php'); ?>