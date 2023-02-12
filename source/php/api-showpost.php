<?php
require_once("db_config.php");

$numeropost = 10;
$var = false;
if (isset($_SESSION["user_id"])){
    $post = $dbh->getPosts($_SESSION["user_id"], $numeropost);



    for($i = 0; $i < count($post); $i++){
        $post[$i]["data"] = date("F j, Y", strtotime($post[$i]["data"]));
        $post[$i]["num_comments"] = $dbh->getPostComments($post[$i]["post_id"]);
        
        /*
        $post[$i]["num_like"] = $dbh->getPostLikes($post[$i]["post_id"]);
        $post[$i]["num_fire"] = $dbh->getPostReactionInfo($post[$i]["post_id"], 2);
        $post[$i]["num_smile"] = $dbh->getPostReactionInfo($post[$i]["post_id"], 3);
        $post[$i]["num_cuore"] = $dbh->getPostReactionInfo($post[$i]["post_id"], 4);
        $post[$i]["num_baci"] = $dbh->getPostReactionInfo($post[$i]["post_id"], 5);
        
        $post[$i]["user_has_like"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 1);
        $post[$i]["user_has_fire"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 2);
        $post[$i]["user_has_smile"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 3);
        $post[$i]["user_has_cuore"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 4);
        $post[$i]["user_has_baci"] = $dbh->hasReacted($post[$i]["post_id"], $_SESSION["user_id"], 5);*/
        
        $reactCount = $dbh->getAllReactionCount($post[$i]["post_id"]);
        $userReactions = $dbh->hasReactedAll($_SESSION["user_id"], $post[$i]["post_id"]);
        $post[$i] = array_merge($post[$i] , $reactCount);
        $post[$i] = array_merge($post[$i] , $userReactions);
        if($post[$i]["esame_id"] != null){
            $post[$i]["nome_esame"]= $dbh->getClassInfo($post[$i]["esame_id"])["nome"];
        } else {
            $post[$i]["nome_esame"] = "";
        }
        
    }
    $var = true;
}

$post1["posts"] = $post;
$post1["success"] = $var;

$templateParams["title"] = "Show Post";
header("Content-Type: application/json");
echo json_encode($post1);

?>