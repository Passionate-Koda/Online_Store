<?php
class RecentlyViewed{
  private $result;
  private function check($dbconn, $userID, $bookID){
    $stmt = $dbconn->prepare("SELECT * FROM recently_viewed WHERE book_id= :bk AND user_id= :ud");
    $stmt->bindParam(':uk', $bookID);
    $stmt->bindParam(':ud', $userID);
    $stmt->execute();

    return $stmt;
  }





  public function insertIntoRecentlyViewed($dbconn, $userID, $bookID) {
    $chk = $this->check($dbconn, $userID, $bookID);
    $count = $chk->rowCounct();

    if($count==0){
      $stmt = $dbconn->prepare("INSERT INTO recently_viewed(book_id, user_id)VALUES(:bi, :ui)");

      $data = [
        ':bi' => $bookID,
        ':ui'=>userID
      ];
      $stmt->execute($data);
    }
  }

  public function selectFromRecentlyViewed($dbconn, $userID){
    $stmt = $dbconn->prepare("select * FROM recently_viewed WHERE user_id= :ui ORDER BY recent_id DESC LIMIT 4");
    $stmt->bindParam('ui', $userID);
    $stmt->execute();

    return $stmt;
  }

  public function selectFromBook($dbconn, $bkid){
    $stmt = $dbcoon -> prepare("SELECT * FROM book WHERE book_id=:bi");
    $stmt->bindParam(':bi', $bkid);
    $stmt->execute();

    return $stmt;
  }

}




 ?>
