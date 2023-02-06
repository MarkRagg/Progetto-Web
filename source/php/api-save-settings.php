<?php
require_once("db_config.php");

$result["success"] = false;

if(isset($_SESSION["user_id"])) {
  $user_info = $dbh->getUserInfo($_SESSION["user_id"]);
  if(isset($_POST["bio"]) && $_POST["bio"] != $user_info["descrizione"]) {
    $result["success"] = true;
    $dbh->updateBio($_SESSION["user_id"], $_POST["bio"]);
  }
  if(isset($_POST["img"]) && $_POST["img"] != "null") {
    $result["success"] = true;
    $dbh->setImageToUser($_POST["img"], $user_info["user_id"]);
  }
}

header("Content-Type: application/json");
echo(json_encode($result));
?>