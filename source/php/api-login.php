<?php
require_once("db_config.php");
$result["login-result"] = false;
$result["login-error"] = "";

if(isset($_POST["email"]) && isset($_POST["password"])) {
  $result["login-result"] = $dbh->login($_POST["email"], $_POST["password"]);
} else {
  $result["login-error"] = "Email or Password wrong!";
}

header('Content-Type: application/json');
echo json_encode($result);

?>