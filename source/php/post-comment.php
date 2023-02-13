<?php 

require_once 'db_config.php';

$templateParams["title"] = "Single Post Page With Comments";
$templateParams["name"] = "show-post-comment.php";


$templateParams["post_exists"] = false;
$templateParams["errormsg"] = "Missing post id";
$templateParams["loggedUser"]=$_SESSION["user_id"];
$templateParams["homepage"] = "";
$templateParams["uni-list"] = "";
$templateParams["notifications"] = "";


$io=$_GET["post_id"];

if (isset($_GET["post_id"])){
    $_SESSION["post_id"] = $_GET["post_id"];

    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../js/reactions.js", "../js/comments.js");
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
        if(isset($post["esame_id"])){
            $templateParams["esame_id"] = $dbh->getClassInfo($post["esame_id"])["nome"];
        } else {
            $templateParams["esame_id"] = null;
        }
        $templateParams["immagine"] = $post["immagine"];
        $templateParams["user_img"] = $dbh->getUserInfo($post["author"])["user_image"];
        $comments = $dbh->getComments($idPost);
        $templateParams["comments"] = $comments;
        $templateParams["numLikes"] = $dbh->getPostLikes($idPost);
        $templateParams["num_fire"] = $dbh->getPostReactionInfo($idPost, 2);
        $templateParams["num_smile"] = $dbh->getPostReactionInfo($idPost, 3);
        $templateParams["num_cuore"] = $dbh->getPostReactionInfo($idPost, 4);
        $templateParams["num_baci"] = $dbh->getPostReactionInfo($idPost, 5);
    } else {
        $templateParams["errormsg"] = "Post not found";
        $templateParams["post_exists"] = false;
    }
}

require_once '../template/base.php'


?>