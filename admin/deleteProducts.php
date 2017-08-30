<?php

$page_title = "Products";
$selectedLnk= "products.php"; $selected_name="Products";
$firstLnk = "adminhome.php" ; $first_name = "Home";
$secondLnk = "category.php"; $second_name = "Category";
$thirdLnk = ""; $third_name = "";
$forthLnk = ""; $forth_name = "";

include 'include/db.php';
include'include/header2.php';
include 'include/footer.php';
include 'include/functions.php';

if(isset($_GET['book_id'])){$getnm = $_GET['book_id'];}else{$getnm="";}
$error = [];

$nm = getProductNameById($conn,$_GET);

if(isset($_POST['no'])){
      header("Location:products.php");

}

if(isset($_POST['yes'])){

    $id= $_GET['id'];



    deleteProduct($conn, $_GET);



}






 ?>
 <h1 id= \"register_label\"> Are You Sure You want to delete <?php echo $nm ?>?</h1>

 <form id="register"  action="" method="post">
  <input type="submit" name="yes" value="Yes">
  <input type="submit" name="no" value="No">
 </form>
