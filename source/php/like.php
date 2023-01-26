<?php

require_once("db_config.php");

$res =" ok ";



if (isset($_POST["post_id"]) && isset($_POST["user"]) && isset($_POST["type"])) {
    $postId = $_POST["post_id"];
    $user = $_POST["user"];
    $type = $_POST["type"];

    $dbh->likePost($postId, $user, $type);

}


header('Content-Type: application/json');
echo json_encode($res);

?>