<?php
require_once("db_config.php");

$numeropost = 10;

$post = $dbh->getPosts($numeropost);


for($i = 0; $i < count($post); $i++){
    $post[$i]["num_like"] = $dbh->getPostLikes($post[$i]["post_id"]);
    $post[$i]["user_has_liked"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 1);
}

$templateParams["title"] = "Show Post";
header("Content-Type: application/json");
echo json_encode($post);

?>