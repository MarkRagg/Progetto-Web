<?php

require_once("db_config.php");

$res =" ok ";



if (isset($_POST["post_id"]) && isset($_SESSION["user_id"]) && isset($_POST["type"])) {
    $postId = $_POST["post_id"];
    $user = $_SESSION["user_id"];
    $type = $_POST["type"];

    $dbh->likePost($postId, $user, $type);

}


header('Content-Type: application/json');
echo json_encode($res);

?>