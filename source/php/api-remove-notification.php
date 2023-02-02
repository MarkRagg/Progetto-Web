<?php
require_once("db_config.php");

$result["success"] = false;

if(isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];
  if(isset($_POST["notification_id"])) {
    $notification_id = $_POST["notification_id"];
    $result["success"] = $dbh->removeNotification($notification_id);
  } else {
    $result["errormsg"] = "Notification_id isn't set";
  }
} else {
  $result["errormsg"] = "You're not logged";
}

header("Content-Type: application/json");
echo(json_encode($result));

?>