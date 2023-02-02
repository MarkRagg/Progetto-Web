<?php
require_once("db_config.php");

$result["new-notification"] = false;

// it checks if there are notifications
if(isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];
  $result["notification-list"] = $dbh->getNotificationsByUser($user_id);
  if(count($result["notification-list"]) > 0) {
    $result["new-notification"] = true;
    $result["following-list"] = array_column($dbh->getFollowing($user_id), "username");
  }
} else {
  $result["errormsg"] = "You're not logged";
}

header("Content-Type: application/json");
echo(json_encode($result));

?>