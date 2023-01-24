<?php
require_once("db_config.php");

$result["found"] = false;

// TODO se utente e' loggato e la richiesta e' vuota ritorna il profilo dell'utente

if (isset($_GET["username"])) {
    $user_exists = $dbh->checkValueInDb("user", "user_id", $_GET["username"]);
    $result["found"] = $dbh->checkValueInDb("user", "user_id", $_GET["username"]);
    if ($user_exists) {
        $result["found"] = true;
        $user = $dbh->getUserInfo($_GET["username"])[0];
        $result["username"] = $_GET["username"];
        $result["name"] = $user["name"];
        $result["surname"] = $user["surname"];
        $result["date_of_birth"] = $user["date_of_birth"];
        $result["residence"] = $user["uni_residence"];
        $result["corso_id"] = $user["corso_id"];
        $result["user_image"] = $user["user_image"];
    } else {
        $result["errormsg"] = "User not found.";
    }
}

header("Content-Type: application/json");
echo json_encode($result)

?>