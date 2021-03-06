<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="styles/styles.css">
    <title><?php echo $page_title ?></title>
</head>

<body id="<?php $body_id ?>">
  <!-- DO NOT TAMPER WITH CLASS NAMES! -->

  <!-- top bar starts here -->
  <div class="top-bar">
    <div class="top-nav">
      <a href="index.html"><h3 class="brand"><span>B</span>rain<span>F</span>ood</h3></a>
      <ul class="top-nav-list">
        <li class="top-nav-listItem Home"><a href="index.php">Home</a></li>
        <li class="top-nav-listItem catalogue"><a href="catalogue.php">Catalogue</a></li>

<?php
session_start();
$sid = md5(session_id());
if(isset($_SESSION['id'])) {
?>
        <li class="top-nav-listItem login"><?php echo $_SESSION['username'] ?></li>
        <li class="top-nav-listItem register"><a href="Logout.php">Logout</a></li>

<?php }else { ?>

  <li class="top-nav-listItem login"><a href="login.php">Login</a></li>
  <li class="top-nav-listItem register"><a href="registration.php">Register</a></li>
<?php } ?>


        <li class="top-nav-listItem cart">
          <div class="cart-item-indicator">
            <p>12</p>
          </div>
          <a href="cart.html">Cart</a>
        </li>
      </ul>
      <form class="search-brainfood">
        <input type="text" class="text-field" placeholder="Search all books">
      </form>
    </div>
  </div>
