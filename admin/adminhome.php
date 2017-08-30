<?php
session_start();
$_SESSION['active'] = true;

$page_title = "Admin Home";
$selectedLnk= "adminhome.php"; $selected_name="Home";
$firstLnk = "category.php" ; $first_name = "Category";
$secondLnk = "products.php"; $second_name = "Products";
$thirdLnk = ""; $third_name="";
$forthLnk = ""; $forth_name = "";

#$deci = $_SESSION['id'];
#$deb = $_SESSION['name'];
#$def = $_SESSION['id'];
include 'include/db.php';
include'include/header2.php';
include 'include/footer.php';
include 'include/functions.php';

 ?>
	<div class="wrapper">
    <h1 id="register-label"></h1>
    <hr>

		<div id="stream">
      <?php #echo "<h1>$deb</h1>"?>






		</div>
	</div>
