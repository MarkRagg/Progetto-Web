<?php
require_once("db_config.php");
define("DEFAULT_IMAGE", "default_image.png");

$result["sign-in-result"] = false;
$result["text-error"] = "";

//code for include json
$strJsonFileContents = file_get_contents("../database/province.json"); 
$array = json_decode($strJsonFileContents, true);
$result["cities"] = array_column($array, 'nome');
//create minimum date allowed to sign in
$date = new DateTime('now');
$date->modify("-14 years");
$date = date_format($date, "Y-m-d");

if(isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["password"])  && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["date"]) && isset($_POST["residence"])) {
  $check_id = $dbh->checkValueInDb("user", "user_id", $_POST["nickname"]);
  $check_email = $dbh->checkValueInDb("user", "email", $_POST["email"]);
  if(!$check_id && !$check_email) {
    if(!empty($_POST["nickname"])) {
      if(!empty($_POST["email"])) {
        if(strlen($_POST['password']) >= 8 && strlen($_POST['password']) <= 16) {
          if(!empty($_POST["name"])) {
            if(!empty($_POST["surname"])) {
              if($_POST["date"] < $date) {
                $result["sign-in-result"] = $dbh->addUser($_POST["nickname"], $_POST["email"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["residence"]);
                $dbh->setImageToUser(DEFAULT_IMAGE, $_POST["nickname"]);
              } else {
                $result["sign-in-result"] = false;
                $result["text-error"] = "L'età minima è 14 anni";
              }
            } else {
              $result["sign-in-result"] = false;
              $result["text-error"] = "Inserire il cognome";
            }
          } else {
            $result["sign-in-result"] = false;
            $result["text-error"] = "Inserire il nome";
          }
        } else {
          $result["sign-in-result"] = false;
          $result["text-error"] = "La password deve essere tra 8-16 caratteri!";
        }
      } else {
        $result["sign-in-result"] = false;
        $result["text-error"] = "Inserire l'email";
      }

    } else {
      $result["sign-in-result"] = false;
      $result["text-error"] = "Inserire il nickname";
    }
  } else if($check_id) {
    $result["sign-in-result"] = false;
    $result["text-error"] = "Il nickame inserito esiste già";
  } else if($check_email) {
    $result["sign-in-result"] = false;
    $result["text-error"] = "L'email inserita esiste già";
  } else {
    $result["sign-in-result"] = false;
    $result["text-error"] = "Qualcosa è andato storto :(";
  }
}

header('Content-Type: application/json');
echo json_encode($result);

?>