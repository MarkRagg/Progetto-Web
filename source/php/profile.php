<?php
require_once 'db_config.php';

$templateParams["title"] = "Profile";
$templateParams["name"] = "show-profile.php";
$templateParams["user_exists"] = false;
$templateParams["errormsg"] = "Missing username";
$templateParams["paginaprofilouser"]=$_SESSION["user_id"];

if (isset($_GET["username"])) {
    $templateParams["user_exists"] = $dbh->checkValueInDb("user", "user_id", $_GET["username"]);
    if ($templateParams["user_exists"]) {
        $user = $dbh->getUserInfo($_GET["username"]);
        $templateParams["username"] = $_GET["username"];
        $templateParams["u_name"] = $user["name"];
        $templateParams["surname"] = $user["surname"];
        $templateParams["date_of_birth"] = $user["date_of_birth"];
        $templateParams["residence"] = $user["uni_residence"];
        $templateParams["corso_id"] = $user["corso_id"];
        $templateParams["user_image"] = $user["user_image"];
        $templateParams["post_count"] = $dbh->getPostCountFromUser($templateParams["username"]);
        $templateParams["follower_count"] = $dbh->getFollowerCount($templateParams["username"]);
        $templateParams["followed_count"] = $dbh->getFollowedCount($templateParams["username"]);
        $templateParams["js"] = array("../js/user-list.js", "https://unpkg.com/axios/dist/axios.min.js");
    } else {
        $templateParams["errormsg"] = "User not found";
    }
}

require '../template/base.php'
?>