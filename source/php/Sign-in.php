<?php
require_once("db_config.php");

$result["sign-in-result"] = false;
$result["text-error"] = "";

if(isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["password"])  && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["date"]) && isset($_POST["residence"])) {
  $check_id = $dbh->checkValueInDb("user", "user_id", $_POST["nickname"]);
  $check_email = $dbh->checkValueInDb("user", "email", $_POST["email"]);
  if(!$check_id && !$check_email) {
    $result["sign-in-result"] = $dbh->addUser($_POST["nickname"], $_POST["email"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["residence"]);
  } else if($check_id) {
    $result["sign-in-result"] = false;
    $result["text-error"] = "Nickname already exists! Retry.";
  } else if($check_email) {
    $result["sign-in-result"] = false;
    $result["text-error"] = "Email already exists! Retry.";
  } else {
    $result["sign-in-result"] = false;
    $result["text-error"] = "Something went wrong!";
  }
}

header('Content-Type: application/json');
echo json_encode($result);

?>