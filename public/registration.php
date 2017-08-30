<?php


include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';
include 'includes/footer.php';

$page_title = "Registration";


$error = [];

if(array_key_exists('submit', $_POST)){

  if(empty($_POST['fname'])){
    $error['fname'] = "*Please enter firstname";
  }

  if(empty($_POST['lname'])){
    $error['lname'] = "*Please enter lastname";
  }

  if(empty($_POST['email'])){
    $error['email'] = "*Please enter email";
  }

  if(doesUserEmailExist($conn, $_POST['email'])){
    $error['email'] = "*Email Exists";
  }




  if(empty($_POST['uname'])){
    $error['uname'] = "*Please enter Username";
  }

  if(empty($_POST['pword'])){
    $error['pword'] = "*Please enter password";
  }

  if(empty($_POST['hash'])){
    $error['hash'] = "*Please enter password";
  }

  if($_POST['pword'] !== $_POST['hash']){
    $error['hash'] = "*Password not match";
  }

  if(empty($error)){
    doUserRegister($conn, $_POST);

  }


}








 ?>
 <form class="search-brainfood">
         <input type="text" class="text-field" placeholder="Search all books">
       </form>
     </div>
   </div>
   <!-- main content starts here -->
   <div class="main">
     <div class="registration-form">
       <form class="def-modal-form" action="registration.php" method="POST">
         <div class="cancel-icon close-form">X</div>
         <?php   if(isset($_GET['success'])){$ms = $_GET['success']; echo "<h3>$ms</h3>";}  ?>
         <label for="registration-from" class="header"><h3>User Registration</h3></label>



         <input type="text" class="text-field first-name" placeholder="Firstname" name="fname">
         <p class="form-error"> <?php
          $err =  displayErrors($error, 'fname');
          echo $err;

           ?></p>


         <input type="text" class="text-field last-name" placeholder="Lastname" name="lname">
         <p class="form-error"> <?php
         $err =  displayErrors($error, 'lname');
         echo $err;
           ?></p>

         <input type="email" class="text-field email" name="email" placeholder="Email">
         <p class="form-error"> <?php
         $err =  displayErrors($error, 'email');
         echo $err;
           ?></p>


         <input type="text" class="text-field username" placeholder="Username" name="uname">
         <p class="form-error"> <?php
         $err =  displayErrors($error, 'uname');
         echo $err;
           ?></p>

         <input type="password" class="text-field password" placeholder="Password" name="pword">
         <p class="form-error"> <?php
         $err =  displayErrors($error, 'pword');
         echo $err;
           ?></p>

         <input type="password" name="hash" class="text-field confirm-password" placeholder="Confirm Password">
         <p class="form-error"> <?php
         $err =  displayErrors($error, 'hash');
         echo $err;
           ?></p>
         <input type="submit" name="submit" class="def-button" value="Register">
         <p class="login-option">Have an account already? Login</p>
       </form>
     </div>
   </div>
