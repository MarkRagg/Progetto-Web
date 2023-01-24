<?php
require_once("db_config.php");
$result["login-result"] = false;
$result["login-error"] = "";

if(isset($_POST["email"]) && isset($_POST["password"])) {
  $login_result = $dbh->login($_POST["email"], $_POST["password"]);
  if(count($login_result) != 0) {
    $result["login-result"] = true;
    registerLoggedUser(array_column($login_result, "user_id")[0]);
  } else {
    $result["login-error"] = "Email or Password wrong!";
  }
}

header('Content-Type: application/json');
echo json_encode($result);

?>