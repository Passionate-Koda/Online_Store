<?php
$page_title = "Home";
$body_id = "home";
include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header2.php';
include 'includes/footer.php';
include 'includes/class.RecentlyViewed.php';
$recent = new RecentlyViewed();

if($_SESSION['id']){
  $uid = $_SESSION['id'];
}



$tt = bestSellingBook($conn);

extract($tt);







 ?>
