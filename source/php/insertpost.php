<?php
require_once("db_config.php");

$templateParams["title"] = "Insert Post";
$templateParams["name"] = "form_add_post.php";

$testo = $_POST["post"];

if ($testo != "" && isset($_SESSION["user_id"])) {
    $dbh->addPost($testo, $_SESSION["user_id"]);
    header("Location: showhomepage.php");
} else {
    var_dump("Errore");
}

require '../template/base.php';
?>