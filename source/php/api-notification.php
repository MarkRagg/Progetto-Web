<?php
require_once("db_config.php");

$result["new-notification"] = false;

if(isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];
  $result["notification-list"] = $dbh->getNotificationsByUser($user_id);
  if(count($result["notification-list"]) > 0) {
    $result["new-notification"] = true;
  }
}

header("Content-Type: application/json");
echo(json_encode($result));

?>