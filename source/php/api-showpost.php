<?php
require_once("db_config.php");

$numeropost = 10;

$post = $dbh->getPosts($numeropost);

//add to $post the $_SESSION["user_id"]
for($i = 0; $i < count($post); $i++){
    $post[$i]["user_id"] = $_SESSION["user_id"];
}

$templateParams["title"] = "Show Post";
header("Content-Type: application/json");
echo json_encode($post);

?>