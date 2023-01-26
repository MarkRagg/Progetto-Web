<?php
require_once("db_config.php");

$result["success"] = false;

if (isset($_GET["username"])) {
    $username = $_GET["username"];
    $nameCheck = $dbh->checkValueInDb("user", "user_id", $username);
    if ($nameCheck) {
        $result["success"] = true;
        $result["userPosts"] = $dbh->getAllUserPosts($username);
    } else {
        $result["errormsg"] = "User not found";
    }
} else {
    $result["errormsg"] = "Missing username";
}

header("Content-Type: application/json");
echo(json_encode($result));
?>