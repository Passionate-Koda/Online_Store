<?php
include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header2.php';
include 'includes/footer.php';
include 'includes/class.RecentlyViewed.php';

$page_title = "Preview";
$body_id = "bookpreview";
$book = getProductByID($conn, $_GET);
extract($book);
$recent = new RecentlyViewed();

if(isset($_SESSION['id'])){
  $uid = $_SESSION['id'];
}





if(isset($_GET['book_id'])){
  $item = getProductByID($conn, $_GET);
  extract($item);
  $book = $book_id;
}









 ?>












<form class="search-brainfood">
  <input type="text" class="text-field" placeholder="Search all books">
</form>
</div>
</div>
<div class="main">

<p class="global-error">You have not chosen any amount!</p>
<div class="book-display">

<div class="display-book" style="background: url('../admin/<?php echo $file_path; ?>');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;"></div>

<div class="info">
  <h2 class="book-title"><?php echo $title ?> </h2>

  <h3 class="book-author"><?php echo "$uid"."$author" ?></h3>
  <h3 class="book-price">$<?php echo $price ?></h3>
  <form>
    <label for="book-amout">Amount</label>
    <input type="number" class="book-amount text-field" name="">
    <input class="def-button add-to-cart" type="submit" name="" value="Add to cart">
  </form>
</div>
</div>
<div class="book-reviews">
<h3 class="header">Reviews</h3>
<ul class="review-list">
  <li class="review">
    <div class="avatar-def user-image">
      <h4 class="user-init">jm</h4>
    </div>
    <div class="info">
      <h4 class="username">Jon Williams</h4>
      <p class="comment">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>
    </div>
  </li>
  <li class="review">
    <div class="avatar-def user-image">
      <h4 class="user-init">AE</h4>
    </div>
    <div class="info">
      <h4 class="username">Abby Essien</h4>
      <p class="comment">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>
    </div>
  </li>
  <li class="review">
    <div class="avatar-def user-image">
      <h4 class="user-init">SB</h4>
    </div>
    <div class="info">
      <h4 class="username">Sandra Bullock</h4>
      <p class="comment">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>
    </div>
  </li>
</ul>
<div class="add-comment">
  <h3 class="header">Add your comment</h3>
  <form class="comment">
    <textarea class="text-field" placeholder="write something"></textarea>
    <button class="def-button post-comment">Upload comment</button>
  </form>
</div>
</div>
</div>
