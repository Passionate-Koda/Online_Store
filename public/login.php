<?php

include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';
include 'includes/footer.php';

$page_title = "User Login";
$error = [];

if(array_key_exists('submit', $_POST)){
  if(empty($_POST['email'])){
    $error['email'] = "*Please Enter Email";
  }

  if(empty($_POST['hash'])){
    $error['hash'] = "*Please enter password";
  }

  if(empty($error)){

$clean = array_map('trim', $_POST);

UserLogin($conn,$clean);




  }

}


 ?>
 <form class="search-brainfood" >
         <input type="text" class="text-field" placeholder="Search all books">
       </form>
     </div>
   </div>
   <!-- main content starts here -->
   <div class="main">
     <div class="login-form">
       <form class="def-modal-form" action="login.php" method="POST">
         <div class="cancel-icon close-form">X</div>
         <label for="login-form" class="header"><h3>Login</h3></label>
         <?php
 		if(isset($_GET['msg'])) {
 			echo '<p class="form-error">'.$_GET['msg'].'</p>';
 		}
 		?>

         <input type="text"name="email" class="text-field email" placeholder="Email">
         <p class="form-error"><?php $st = displayErrors($error, 'email');
         echo $st ?></p>
         <input type="password" name="hash" class="text-field password" placeholder="Password">
         <!--clear the error and use it later just to show you how it works -->
         <p class="form-error"><?php $st = displayErrors($error, 'hash');
         echo $st ?></p>
         <input type="submit" name="submit" class="def-button login" value="Login">
       </form>
     </div>
   </div>
