<?php
$page_title = "Admin Login";
include 'include/db.php';
include 'include/header.php';
include 'include/footer.php';
include 'include/functions.php';

$error = [];

if(array_key_exists('login', $_POST)){

if(empty($_POST['email'])){
$error['email'] = "Please enter email";

}


if(empty($_POST['password'])){
  $error['password'] = "please enter password";
}

if(empty($error)){
$clean = array_map('trim', $_POST);

adminLogin($conn, $clean);

#if($ver[0]== true){

#  $row = $ver[1];
  #$_SESSION['id'] = $row['admin_id'];
  #$_SESSION['admin_name'] = $row['firstname'];

  #header("Location:adminhome.php");
}

}






 ?>




<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="adminlogin.php" method ="POST">

			<div>


				<?php


				$display = displayErrors($error, 'email');
				echo $display;
				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php
				$pass = 'password';
				$display = displayErrors($error, $pass);
				echo $display;
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>


			<input type="submit" name="login" value="Login">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
