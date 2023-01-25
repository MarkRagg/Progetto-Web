<?php
require_once("db_config.php");

$templateParams["title"] = "Insert Post";
$templateParams["name"] = "form_add_post.php";
var_dump($_SESSION["user_id"]);

//$dbh->addPost(null,$_SESSION["user_id"]);
//var_dump($dbh->getPostCountFromUser("io"))[0]);
var_dump($_POST["submit"]);

if (isset($_POST["post"])) {
    //$dbh->insertPost("aa", $_SESSION["user_id"]);
    //header("Location: ../php/showhomepage.php");
}
var_dump("ciao");
require '../template/base.php';
?>