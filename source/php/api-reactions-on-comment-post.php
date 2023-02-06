<?php

require_once("db_config.php");

if(isset($_POST["post_id"])){
    $idPost = $_POST["post_id"];
    $templateParams[0]["user_has_liked"] = $dbh->hasReacted($idPost, $_SESSION["user_id"], 1);
    $templateParams[0]["user_has_fired"] = $dbh->hasReacted($idPost, $_SESSION["user_id"], 2);
    $templateParams[0]["user_has_smile"] = $dbh->hasReacted($idPost, $_SESSION["user_id"], 3);
    $templateParams[0]["user_has_cuore"] = $dbh->hasReacted($idPost, $_SESSION["user_id"], 4);
    $templateParams[0]["user_has_bacio"] = $dbh->hasReacted($idPost, $_SESSION["user_id"], 5);
    $templateParams[0]["post_id"] = $idPost;
    $templateParams[0]["error"] = false;
} else {
    $templateParams[0]["error"] = true;
}

header("Content-Type: application/json");
echo(json_encode($templateParams));

?>