<?php

session_start();
$_SESSION['active'] = true;

#Links to the header2.php
$page_title = "Edit Product";
$selectedLnk= "editProducts.php"; $selected_name="Edit Products";
$firstLnk = "adminhome.php" ; $first_name = "Home";
$secondLnk = "category.php"; $second_name = "Category";
$thirdLnk = ""; $third_name = "";
$forthLnk = ""; $forth_name = "";


$page_title = "Add Products";
include 'include/db.php';
include 'include/header2.php';
include 'include/footer.php';
include 'include/functions.php';



if($getp = getProductById($conn,$_GET)){
  extract($getp);
}else{
  $getp = "";
}




$flag = array("top-selling", "trending", "popular-demand");


$error = [];

if(array_key_exists('add', $_POST)){
  define("MAX_FILE_SIZE", "2097152");

  $ext = ["image/jpg", "image/JPG", "image/jpeg", "image/JPEG", "image/PNG", "image/png"];

  if(empty($_POST['title'])){
    $error['title'] = "Please enter book title";
  }


  if(empty($_POST['author'])){
    $error['author'] = "Please enter book author";
  }

  if(empty($_POST['category'])){
    $error['category'] = "Please enter book category";
  }

  if (empty($_POST['price'])){
    $error['price'] = "please enter price";
  }

  if(empty($_POST['year'])){
    $error['year'] = "Please enter year of publication";
  }

  if(empty($_POST['isbn'])){
    $error['isbn'] = "please enter ISBN";
  }

  if(empty($_POST['flag'])){
    $error['flag'] = "please enter flag";
  }

  if(empty($_FILES['pic']['name'])){
    $error['pic'] = "please choose a file";
  }

  if($_FILES['pic']['size'] > MAX_FILE_SIZE){
    $error['pic'] = "file size exceeds maximum. maximum:".MAX_FILE_SIZE;
  }

  if(!in_array($_FILES['pic']['type'], $ext)){
    $error['pic'] = "Invalid file type";
  }



  if(empty($error)){
    $ver = uploadFiles($_FILES, 'pic', 'uploads/');

    if($ver[0]){
      $destination = $ver[1];



  $clean = array_map('trim', $_POST);

  editProducts($conn,$clean,$destination,$_GET['book_id']);
}
}

}




 ?>

<div class="wrapper">
 <h2>PLEASE SELECT FILE</h2>
<form id="register" action="<?php echo "editProducts.php?book_id=$_GET[book_id]" ?>" method="POST" enctype="multipart/form-data">
<div class="">
<label >Upload file</label>
<input type="file" name="pic" >
</div>

 <div class="">


<label for="">BOOK TITLE</label>
<input type="text" name="title" value="<?php if(!isset($_GET['book_id'])){
  $title = "";
}else{ echo $title;}  ?>" placeholder="Book Name">
</div>

<div class="">


<label for="">AUTHOR </label>
 <input type="text" name="author" value="<?php if(!isset($_GET['book_id'])){
   $title = "";
 }else{ echo $author;}  ?>" placeholder="Author">
</div>




<div class="">
  <label for="">CATEGORY</label>
  <select class="" name="category">
  <option value="">-Select Category-</option>
  <?php  viewCategory($conn) ?>
  </select>
</div>


<div class="">


<label for="">PRICE</label>
<input type="text" name="price" value="<?php if(!isset($_GET['book_id'])){
  $title = "";
}else{ echo $price;}  ?>" placeholder="Price of book">
</div>


<div class="">


<label for="">YEAR OF PUBLICATION</label>
<input type="text" name="year" value="<?php if(!isset($_GET['book_id'])){
  $title = "";
}else{ echo $year;}  ?>" placeholder="Year of Publication">
</div>

<div class="">

  <label for="">ISBN</label>
  <input type="text" name="isbn" value="<?php if(!isset($_GET['book_id'])){
    $title = "";
  }else{ echo $ISBN;}  ?>" placeholder="ISBN">

</div>

<div class="">
  <label for="">Flag</label>
  <select class="" name="flag">

    <option value="">-Select Flag-</option>

    <?php foreach($flag as $ff){?>
    <option value="<?php echo $ff  ?>">
  <?php echo $ff  ?>
  </option>
<?php  }?>
  </select>

</div>

<input type="submit" name="add" value="Edit Product">
</form>


</div>
