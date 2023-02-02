<?php 

require_once 'db_config.php';

$templateParams["title"] = "Single Post Page With Comments";
$templateParams["name"] = "show-post-comment.php";


$templateParams["post_exists"] = false;
$templateParams["errormsg"] = "Missing post id";
$templateParams["loggedUser"]=$_SESSION["user_id"];


$io=$_GET["post_id"];

if (isset($_GET["post_id"])){
    $_SESSION["post_id"] = $_GET["post_id"];

    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../js/comments.js");
    $idPost = $_GET["post_id"];
    $templateParams["post_exists"] = $dbh->checkValueInDb("post", "post_id", $idPost);
    if ($templateParams["post_exists"]) {
        $post = $dbh->getPost($idPost);
        $templateParams["post_exists"] = true;
        $templateParams["errormsg"] = "Post found";
        $templateParams["post_id"] = $post["post_id"];
        $templateParams["author"] = $post["author"];
        $templateParams["data"] = date("F j, Y", strtotime($post["data"]));
        $templateParams["string"] = $post["string"];
        $templateParams["esame_id"] = $post["esame_id"];
        $comments = $dbh->getComments($idPost);
        $templateParams["comments"] = $comments;
        $templateParams["numLikes"] = $dbh->getPostLikes($idPost);
        
    } else {
        $templateParams["errormsg"] = "Post not found";
    }
}

require_once '../template/base.php'


?>