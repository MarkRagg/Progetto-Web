<?php
require_once("db_config.php");

$result["logged"] = false;

if(isset($_SESSION["user_id"])) {  
  //code for include json
  $strJsonFileContents = file_get_contents("../database/province.json"); 
  $array = json_decode($strJsonFileContents, true);
  $result["cities"] = array_column($array, 'nome');

  $user_id_info = $dbh->getUserInfo($_SESSION["user_id"]);
  $result["bio"] = $user_id_info["descrizione"];
  $result["logged"] = true;
  $result["user_id"] = $_SESSION["user_id"];
  $result["current-residence"] = $user_id_info["uni_residence"];
} else {
  $result["errormsg"] = "User not logged";
}

header("Content-Type: application/json");
echo(json_encode($result));
?>