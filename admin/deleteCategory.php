<?php

$page_title = "Edit Category";
$selectedLnk= "editCategory.php"; $selected_name="Edit Category";
$firstLnk = "adminhome.php" ; $first_name = "Home";
$secondLnk = "category.php"; $second_name = "Category";
$thirdLnk = ""; $third_name = "";
$forthLnk = ""; $forth_name = "";

include 'include/db.php';
include'include/header2.php';
include 'include/footer.php';
include 'include/functions.php';

if(isset($_GET['name'])){$getnm = $_GET['name'];}else{$getnm="";}
$error = [];

if(isset($_POST['no'])){

  if(empty($error)){
      header("Location:category.php");
  }
}

if(isset($_POST['yes'])){
  if(empty($error)){
    $id= $_GET['id'];



    deleteCategory($conn, $_GET);

  }

}






 ?>
 <h1 id= \"register_label\"> Are You Sure You want to delete <?php echo $getnm ?>?</h1>

 <form id="register"  action="" method="post">
  <input type="submit" name="yes" value="Yes">
  <input type="submit" name="no" value="No">
 </form>
