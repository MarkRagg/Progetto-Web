<?php
require_once("db_config.php");

$templateParams["title"] = "Modifica Post";
$templateParams["homepage"] = "link-secondary";
$templateParams["uni-list"] = "";
$templateParams["notifications"] = "";

if (isset($_GET["post_id"]) && isset($_SESSION["user_id"])) {
    $loggedUserId = $_SESSION["user_id"];
    $post_id = $_GET["post_id"];
    $post_exists = $dbh->checkValueInDb("post", "post_id", $post_id);
    if ($post_exists) {
        $postInfo = $dbh->getPost($post_id);
        if ($postInfo["author"] === $loggedUserId) {
            $templateParams["post_info"] = $postInfo;
            $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../js/modify-post.js");
            $templateParams["name"] = "show-modify-post.php";
        } else {
            $templateParams["name"] = "show-error.php";
            $templateParams["errormsg"] = "Logged user isn't post author";
        }
    } else {
        $templateParams["name"] = "show-error.php";
        $templateParams["errormsg"] = "Post not found";
    }
} else {
    $templateParams["name"] = "show-error.php";
    $templateParams["errormsg"] = "Post id missing or user not logged";
}

require '../template/base.php';
?>