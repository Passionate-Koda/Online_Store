<?php
session_start();
$_SESSION['active'] = true;
$page_title = "Admin Home";
$selectedLnk= "category.php"; $selected_name="Category";
$firstLnk = "adminhome.php" ; $first_name = "Home";
$secondLnk = "products.php"; $second_name = "Products";
$thirdLnk = ""; $third_name = "";
$forthLnk = ""; $forth_name = "";



include 'include/db.php';
include'include/header2.php';
include 'include/footer.php';
include 'include/functions.php';



$error = [];

if(array_key_exists('add', $_POST)){

if(empty($_POST['categ'])){
  $error['categ'] = "*please enter a category name</br>";
}

if(empty($error)){
  addCategory($conn, $_POST);


}
}




 ?>





	<div class="wrapper">
    <div id="stream">

      <h1 id="register-label">Add Category</h1>
      <hr>

    <form id="register" class="" action="" method="post">
      <?php $display = displayErrors($error, 'categ');
      echo $display; ?>
    <input type="text" name="categ" value="" placeholder="Add Category">
    <input type="submit" name="add" value="Add">

    </form>



<h1 id="register-label">Categories</h1>
<hr>
  			<table id="tab">



  				<thead>
  					<tr>
  						<th>category id</th>
  						<th>category name</th>
  						<th>date created</th>
  						<th>edit</th>
  						<th>delete</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php

  					viewCategories($conn);


  					?>

            		</tbody>
  			</table>






		</div>
	</div>
