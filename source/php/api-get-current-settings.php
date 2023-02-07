<?php
require_once("db_config.php");

$result["logged"] = false;

if(isset($_SESSION["user_id"])) {
  $user_id_info = $dbh->getUserInfo($_SESSION["user_id"]);
  $result["bio"] = $user_id_info["descrizione"];
  $result["user_current_course"] = $user_id_info["corso_id"];
  if($user_id_info["corso_id"] != null) {
    $result["user_current_uni"] = $dbh->getUniFromCourse($user_id_info["courso_id"]);
  }
  $result["unis"] = $dbh->getAllUnis();
  $result["courses"] = $dbh->getCoursesFromUni($result["unis"][0]);
  $result["logged"] = true;
  $result["user_id"] = $_SESSION["user_id"];
} else {
  $result["errormsg"] = "User not logged";
}

header("Content-Type: application/json");
echo(json_encode($result));
?>