<?php
require_once("db_config.php");
define("DEFAULT_IMAGE", "default_image.png");

$result["sign-in-result"] = false;
$result["text-error"] = "";

//code for include json
$strJsonFileContents = file_get_contents("../database/province.json"); 
$array = json_decode($strJsonFileContents, true);
$result["cities"] = array_column($array, 'nome');

if(isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["password"])  && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["date"]) && isset($_POST["residence"])) {
  $check_id = $dbh->checkValueInDb("user", "user_id", $_POST["nickname"]);
  $check_email = $dbh->checkValueInDb("user", "email", $_POST["email"]);
  if(!$check_id && !$check_email) {
    if(!empty($_POST["nickname"])) {
      if(!empty($_POST["email"])) {
        if(strlen($_POST['password']) >= 8 && strlen($_POST['password']) <= 16) {
          if(!empty($_POST["name"])) {
            if(!empty($_POST["surname"])) {
              $result["sign-in-result"] = $dbh->addUser($_POST["nickname"], $_POST["email"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["residence"]);
              $dbh->setImageToUser(DEFAULT_IMAGE, $_POST["nickname"]);
            } else {
              $result["sign-in-result"] = false;
              $result["text-error"] = "Surname is empty!";
            }
          } else {
            $result["sign-in-result"] = false;
            $result["text-error"] = "Name is empty!";
          }
        } else {
          $result["sign-in-result"] = false;
          $result["text-error"] = "Password must be in a range of 8-16 characters!";
        }
      } else {
        $result["sign-in-result"] = false;
        $result["text-error"] = "Email is empty!";
      }

    } else {
      $result["sign-in-result"] = false;
      $result["text-error"] = "Nickname is empty!";
    }
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