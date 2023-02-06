<?php

require_once("db_config.php");

if(isset($_POST["post_id"])){
    $idPost = $_POST["post_id"];
    $reactCount = $dbh->getAllReactionCount($idPost);
    $userReactions = $dbh->hasReactedAll($_SESSION["user_id"], $idPost);
    $templateParams[0] =  $reactCount;
    $templateParams[0] = array_merge($templateParams[0], $userReactions);
    $templateParams[0]["post_id"] = $idPost;
    $templateParams[0]["error"] = false;
} else {
    $templateParams[0]["error"] = true;
}

header("Content-Type: application/json");
echo(json_encode($templateParams));

?>