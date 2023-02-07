<?php
require_once("db_config.php");

$result["unis"] = $dbh->getAllUnis();
if(isset($_POST["uni-selected"])) {
  $result["uni-selected"] = $_POST["uni-selected"];
  $result["courses"] = $dbh->getCoursesFromUni($_POST["uni-selected"]);
} else {
  $result["courses"] = $dbh->getCoursesFromUni($result["unis"][0]);
}

header("Content-Type: application/json");
echo(json_encode($result));
?>