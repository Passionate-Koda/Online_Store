<?php #title
$page_title = "Register";

#
include'include/db.php';

include'include/functions.php';

include'include/header.php';

include'include/footer.php';
//include('include/function.php');
$error= [];

if(array_key_exists('register', $_POST)){

  if(empty($_POST['fname'])){
    $error['fname']="Enter a firstname";
  }

  if(empty($_POST['lname'])){
    $error['lname']="Enter a lastname";
  }

  if(empty($_POST['email'])){
    $error['email']="Enter a email";
  }

  if(doesEmailExist($conn,$_POST['email'])){
    $error['email'] = "*email already exists";
  }



  if(empty($_POST['password'])){
    $error['password']="Enter a password";
  }
  if(empty($_POST['pword'])){
    $error['pword']="enter confirm password";
  }

  if($_POST['pword']!=$_POST['password']){
    $error['pword']="Password mismatch";
  }

  if(empty($error)){
    $clean = array_map('trim', $_POST);
    doAdminRegister($conn, $clean);
    }
}

?>


	<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
        <?php
        $display = displayErrors($error, 'fname');
        echo $display;
        ?>



				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div><?php
      $display = displayErrors($error, 'lname');
      echo $display;
      ?>

				<label>last name:</label>
				<input type="text" name="lname" placeholder="last name">
			</div>

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
				$display = displayErrors($error, 'password');
				echo $display;
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<div>
        <?php
        $display = displayErrors($error, 'password');
				echo $display;
        ?>
				<label>confirm password:</label>
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="adminlogin.php">login</a></h4>
	</div>
