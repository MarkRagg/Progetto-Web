<?php
require_once("db_config.php");

$result["sign-in-result"] = false;
$result["text-error"] = "";

if(isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["password"])  && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["date"]) && isset($_POST["residence"])) {
  if(!$dbh->checkValueInDb("user", "user_id", $_POST["nickname"])) {
    $result["sign-in-result"] = $dbh->addUser($_POST["nickname"], $_POST["email"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["residence"]);
  } else {
    $result["sign-in-result"] = false;
    $result["text-error"] = "Nickname already exists! Retry.";
  }
}

header('Content-Type: application/json');
echo json_encode($result);

?>