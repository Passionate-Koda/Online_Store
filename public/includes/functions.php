<?php

function doesEmailExist($dbconn, $input){ #placeholders are just there
  $result = false;

  $stmt = $dbconn -> prepare("SELECT * FROM admin WHERE email = :em");
  $stmt->bindParam(":em",$input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}



function doesUserEmailExist($dbconn, $input){ #placeholders are just there
  $result = false;

  $stmt = $dbconn -> prepare("SELECT * FROM users WHERE email = :em");
  $stmt->bindParam(":em",$input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}




function doAdminRegister($dbconn, $input){
$hash = password_hash($input['password'], PASSWORD_BCRYPT);

#insert data

$stmt = $dbconn->prepare("INSERT INTO admin(firstname,lastname,email,hash) VALUES(:fn, :ln, :e, :h)");

#bind params...
$data = [ ':fn' => $input['fname'],
  ':ln' => $input['lname'],
  ':e' => $input['email'],
  ':h' => $hash
];

$stmt->execute($data);
}

function doUserRegister($dbconn, $input){
  $hash = password_hash($input['hash'], PASSWORD_BCRYPT);


$stmt =$dbconn->prepare("INSERT INTO users(firstname,lastname,email,username,password,hash) VALUES(:fname, :lname, :em, :uname, :pword, :h)");

$stmt->bindParam(":fname", $input['fname']);
$stmt->bindParam(":lname", $input['lname']);
$stmt->bindParam(":em", $input['email']);
$stmt->bindParam(":uname", $input['uname']);
$stmt->bindParam(":pword", $input['pword']);
$stmt->bindParam(":h", $hash);

$stmt->execute();

$success= "Registration successful";

header("Location:registration.php?success=$success");
}






function displayErrors($error, $field)
{
  $result= "";
  if (isset($error[$field]))
  {
    $result = '<span class="err">'.$error[$field].'</span>';
  }
  return $result;
}


function adminLogin($dbconn, $input){
  $result = [];

  $stmt = $dbconn->prepare("SELECT * FROM admin WHERE email = :e ");

  $stmt ->bindParam(":e", $input['email']);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_BOTH);

  if($stmt->rowCount() !=1 || !password_verify($input['password'], $row['hash'])){
    header('adminlogin.php');
  }else{
    $result[] = true;
    $result[] = $row;
    extract($row);
    $_SESSION['id'] = $admin_id;
    $_SESSION['name'] = $firstname;

    header("Location:adminhome.php");
  }
return $result;
return $_SESSION['name'];

}





function addCategory($dbconn, $post){

$stmt = $dbconn->prepare("INSERT INTO category(category_name, date_created) VALUES(:cat,NOW())");

$stmt->bindParam(":cat",$post['categ']);

$stmt->execute();

$success = "Category Succefully Added";
header("Location:category.php?success=$success");
}





function UserLogin($dbconn, $input){
  $result = [];

  $stmt = $dbconn->prepare("SELECT * FROM users WHERE email = :e ");

  $stmt ->bindParam(":e", $input['email']);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_BOTH);

  if($stmt->rowCount() > 0 && password_verify($input['hash'], $row['hash'])){
    extract($row);
  $_SESSION['username'] = $username;
  $_SESSION['id'] = $user_id;
    header("Location:index.php");

  }else{

    header("Location:login.php?msg=invalid email or password");

  }



}




function viewProducts($dbconn){



  $stmt = $dbconn->prepare("SELECT * FROM book");

  $stmt->execute();

  while($record = $stmt->fetch()){

echo "<tr>";
echo "<td>".$record['book_id']."</td>";

echo "<td>".$record['title']."</td>";
echo "<td>".$record['author']."</td>";
echo "<td>".$record['category']."</td>";
echo "<td>".$record['price']."</td>";
echo "<td>".$record['year']."</td>";
echo "<td>".$record['ISBN']."</td>";
echo "<td>".$record['file_path']."</td>";
echo "<td>".$record['flag']."</td>";

echo "<td><a href=\"editProducts.php?book_id=".$record['book_id']."\">edit</a></td>";
echo "<td><a href=\"deleteProducts.php?book_id=".$record['book_id']."\">delete</a></td>";
echo "</tr>";
  }
}



function viewCategories($dbconn){



  $stmt = $dbconn->prepare("SELECT * FROM category");

  $stmt->execute();

  while($record = $stmt->fetch()){

echo "<tr>";
echo "<td>".$record['category_id']."</td>";

echo "<td>".$record['category_name']."</td>";
echo "<td>".$record['date_created']."</td>";
echo "<td><a href=\"editCategory.php?id=".$record['category_id']."&name=".$record['category_name']."\">edit</a></td>";
echo "<td><a href=\"deleteCategory.php?id=".$record['category_id']."&name=".$record['category_name']."\">delete</a></td>";
echo "</tr>";
  }
}


function viewCategory($dbconn){



  $stmt = $dbconn->prepare("SELECT * FROM category");

  $stmt->execute();

  while($record = $stmt->fetch()){
    extract($record);


echo "<option value=\" $category_name\">$category_name</option>";
}
}



function editCategory($dbconn, $post, $get){

  $stmt = $dbconn->prepare("UPDATE category SET category_name=:name WHERE category_id= :id");

  $stmt->bindParam(":name" , $post['category']);
  $stmt -> bindParam(":id", $get['id']);
  $stmt->execute();

  header("Location:category.php");
}

function getCategoryById($dbconn,$get){
$stmt= $dbconn->prepare("SELECT * FROM category WHERE category_id = :cat");

$stmt->bindParam(":cat", $get['id']);
$stmt->execute();

$cal = $stmt->fetch(PDO::FETCH_BOTH);
extract($cal);



return $category_name;




}


function getProductNameById($dbconn,$get){
$stmt= $dbconn->prepare("SELECT * FROM book WHERE book_id = :cat");

$stmt->bindParam(":cat", $get['book_id']);
$stmt->execute();

$cal = $stmt->fetch(PDO::FETCH_BOTH);
extract($cal);



return $title;




}





function deleteCategory($dbconn, $get){



  $stmt= $dbconn->prepare("DELETE FROM category WHERE category_id=:id");

  $stmt -> bindParam(":id", $get['id']);

  $stmt->execute();
header("Location:category.php");

}



function deleteProduct($dbconn, $get){



  $stmt= $dbconn->prepare("DELETE FROM book WHERE book_id=:id");

  $stmt -> bindParam(":id", $get['book_id']);

  $stmt->execute();
header("Location:products.php");

}


function uploadFiles($input, $name, $upDIR){
  $result = [];

  $rnd = rand(0000000, 9999999);
  $strip_name = str_replace(" ", "_", $input[$name]['name']);

  $filename= $rnd.$strip_name;
  $destination = $upDIR.$filename;

  if(!move_uploaded_file($input[$name]['tmp_name'], $destination)){
    $result[] = false;

}else{
    $result[] = true;
    $result[] = $destination;
}
return $result;
}

function addProducts($dbconn,$post,$destination){

$stmt = $dbconn->prepare("INSERT INTO book VALUES(NULL,:title,:author,:category,:price,:year,:IS,:destn,:fl)");


    $data = [
      ':title' => $post['title'],
    ':author' => $post['author'],
    ':category' => $post['category'],
    ':price' => $post['price'],
    ':year' => $post['year'],
    ':IS' => $post['isbn'],
    ':fl' => $post['flag'],
    ':destn' => $destination
  ];

    $stmt->execute($data);

    $success = "product Successfully added";

    header("Location:addProducts.php?success=$success");
}

function getProductById($dbconn,$get){


$stmt= $dbconn->prepare("SELECT * FROM book WHERE book_id = :cat");

$stmt->bindParam(":cat", $get['book_id']);
$stmt->execute();

$cal = $stmt->fetch(PDO::FETCH_BOTH);




return $cal;




}


function editProducts($dbconn,$post,$destination,$get){
$result = [];
$stmt = $dbconn->prepare("UPDATE book SET title=:title, author=:author, category=:category, price=:price, year=:year, ISBN=:IS, file_path=:destn, flag=:fl WHERE book_id =:id");


    $data = [
      ':title' => $post['title'],
    ':author' => $post['author'],
    ':category' => $post['category'],
    ':price' => $post['price'],
    ':year' => $post['year'],
    ':IS' => $post['isbn'],
    ':fl' => $post['flag'],
    ':destn' => $destination,
    ':id' => $get['id']
  ];

    $stmt->execute($data);


    $success = "Done";
    header("Location:products.php?success=$success");
}



function bestSellingBook($dbconn){
  $popular = "popular-demand";
  $stmt = $dbconn->prepare("SELECT * FROM book WHERE flag= :bs   ");
  $stmt->bindParam(":bs", $popular);

  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_BOTH);

return $row;

}

function trending($dbconn){
$td = "trending";
$stmt =$dbconn->prepare("SELECT * FROM book WHERE flag=:tr");
$stmt->bindParam(":tr", $td);
$stmt->execute();

$result = "";

while($row = $stmt->fetch(PDO::FETCH_BOTH)){
  extract($row);

$result = $result .
"<li class='book' >".
    "<a href='bookpreview.php?book_id=".$book_id."'>".
      "<div class='book-cover' style=\"background:url('../admin/".$file_path."');".
      "background-size: cover; background-position: center; background-repeat: no-repeat;\">".
      "</div>".
    "</a>".
  "<div class='book-price'><p>$" .$price. "</p></div>".
  "</li>";
}

return $result;


}



function recentlyViewed($dbconn){
$rvv = "top-selling";
$stmt =$dbconn->prepare("SELECT * FROM book WHERE flag=:rv");
$stmt->bindParam(":rv", $rvv);
$stmt->execute();

$result = "";

while($row = $stmt->fetch(PDO::FETCH_BOTH)){
  extract($row);

$result = $result .
"<li class='book' >".
    "<a href='bookpreview.php?book_id=".$book_id."'>".
      "<div class='book-cover' style=\"background:url('../admin/".$file_path."');".
      "background-size: cover; background-position: center; background-repeat: no-repeat;\">".
      "</div>".
    "</a>".
  "<div class='book-price'><p>$" .$price. "</p></div>".
  "</li>";
}

return $result;


}




 ?>
