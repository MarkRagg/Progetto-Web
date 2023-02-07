<?php
require_once("db_config.php");

$result["unis"] = $dbh->getAllUnis();
if(isset($_POST["uni-selected"])) {
  $result["uni-selected"] = $_POST["uni-selected"];
  $result["courses"] = $dbh->getCoursesFromUni($_POST["uni-selected"]);
} else {
  $result["course-selected"] = $dbh->getUserInfo($_SESSION["user_id"])["corso_id"];
  $result["uni-selected"] = $dbh->getUniFromCourse($result["course-selected"]);
  $result["courses"] = $dbh->getCoursesFromUni($result["uni-selected"]);
}

header("Content-Type: application/json");
echo(json_encode($result));
?>