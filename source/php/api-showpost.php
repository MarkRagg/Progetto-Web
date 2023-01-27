<?php
require_once("db_config.php");

$numeropost = 10;

$post = $dbh->getPosts($numeropost);


for($i = 0; $i < count($post); $i++){
    $post[$i]["num_like"] = $dbh->getPostLikes($post[$i]["post_id"]);
}

$templateParams["title"] = "Show Post";
header("Content-Type: application/json");
echo json_encode($post);

?>