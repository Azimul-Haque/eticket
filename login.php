

<?php 
	include('menu.php'); 
	session_start();
	session_unset();
	session_destroy();
	$_SESSION = array(); 
?>

<div class="container" style="margin-top:70px">
  		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12 text-center">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login" id="login" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="#!" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
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
	//php script to login & validation
	//session_start();
	if(isset($_POST['login'])){
	$username = mysqli_real_escape_string($conn, $_POST['username']);	
	$password = mysqli_real_escape_string($conn, $_POST['password']);	
		if($conn){
		$query = "SELECT * from users WHERE username = '$username'";
		$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					if($password==$row['password'] && $username==$row['username']){
						if(empty($_SESSION["username"])){
							session_start();
							$_SESSION["username"] = $row['username'];
							$_SESSION["email"] = $row['email'];
							$_SESSION["role"] = $row['role'];
							//echo "session added!";
						}else {
							//echo "problem is here!";
						}
						echo "<center><h2 style='background:yellow;max-width:380px;'>Success</h2></center>";
						//echo $_SESSION["username"];
						//echo $_SESSION["Name"];
						echo "<script>window.location.href = 'index.php';</script>";
					} else{
						$_SESSION["username"] = "";
						session_unset();
						echo "<center><h2 style='background:red;max-width:380px;'>Apply correct credentials.</h2></center>";
						//echo "<script>window.location.href = 'index.php';</script>";
					}
				}
			}else{
				$_SESSION["username"] = "";
				session_unset();
				echo "<center><h2 style='background:red;max-width:380px;'>Apply correct credentials.</h2></center>";
				//echo "<script>window.location.href = 'index.php';</script>";
			}
		}else{
			echo "not connected";
		}
	}

?>


<?php include('footer.php'); ?>