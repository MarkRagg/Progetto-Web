<?php

require_once 'db_config.php';

if (isset($_POST["num"])) {
    $numeropost = 5;
    $scarto = $_POST["num"];
    $post = $dbh->getMorePosts($_SESSION["user_id"], $numeropost, $scarto);

    for($i = 0; $i < count($post); $i++){
        $post[$i]["data"] = date("F j, Y", strtotime($post[$i]["data"]));
        $post[$i]["num_comments"] = $dbh->getPostComments($post[$i]["post_id"]);
        
        $post[$i]["num_like"] = $dbh->getPostLikes($post[$i]["post_id"]);
        $post[$i]["num_fire"] = $dbh->getPostReactionInfo($post[$i]["post_id"], 2);
        $post[$i]["num_smile"] = $dbh->getPostReactionInfo($post[$i]["post_id"], 3);
        $post[$i]["num_cuore"] = $dbh->getPostReactionInfo($post[$i]["post_id"], 4);
        
        $post[$i]["user_has_liked"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 1);
        $post[$i]["user_has_fired"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 2);
        $post[$i]["user_has_smile"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 3);
        $post[$i]["user_has_cuore"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 4);
    }

    $templateParams["title"] = "Show Post";
    header("Content-Type: application/json");
    echo json_encode($post);
} else {
    
}





?>