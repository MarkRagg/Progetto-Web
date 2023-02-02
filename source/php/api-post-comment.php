<?php

require_once 'db_config.php';
include 'bhp.php';


/*
if(isset($_SESSION["post_id"])){
    $idPost = $_SESSION["post_id"];
    $parm["post_exists"] = $dbh->checkValueInDb("post", "post_id", $idPost);
    if ($parm["post_exists"]) {
        $post = $dbh->getPost($idPost);
        $parm["post_exists"] = true;
        $parm["errormsg"] = "Post found";
        $parm["post_id"] = $post["post_id"];
        $parm["author"] = $post["author"];
        $parm["data"] = $post["data"];
        $parm["string"] = $post["string"];
        $parm["esame_id"] = $post["esame_id"];
        $comments = $dbh->getComments($idPost);
        $parm["comments"] = $comments;
        $parm["numLikes"] = $dbh->getPostLikes($idPost);
        
    } else {
        $parm["errormsg"] = "Post not found";
    }
}


echo($_SESSION["post_id"]);
echo "<br>";
echo($io);
*/

header('Content-Type: application/json');
echo json_encode($no);
//echo json_encode($io["io"]);

?>