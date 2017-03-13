

<?php 
	include('menu.php'); 
?>

<div class="container" style="margin-top:70px">
  		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12 text-center">
								<a href="#" class="active" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="register-form" action="register.php" method="POST" role="form" style="display: block;" data-parsley-validate="">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required="">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required="" data-parsley-equalto="#password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<button type="submit" name="submit" id="submit" tabindex="4" class="form-control btn btn-register">Register Now</button>
											</div>
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

<?php

	
	if(isset($_POST['submit'])) {

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = 'customer';
		$created_at = date("Y-m-d H:i:s");
		$updated_at = date("Y-m-d H:i:s");

		$sql = "INSERT INTO users (username, email, password, role, created_at, updated_at)
		VALUES ('$username', '$email', '$password', '$role', '$created_at', '$updated_at')";

		if (mysqli_query($conn, $sql)) {
		    echo "<center>Registered successfully! <a href='login.php'>Login Now</a></center>";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	} 


?>

<?php include('footer.php'); ?>