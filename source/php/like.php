<?php

require_once("db_config.php");

$res =" ok ";



if (isset($_POST["post_id"]) && isset($_SESSION["user_id"]) && isset($_POST["type"])) {
    $postId = $_POST["post_id"];
    $user = $_SESSION["user_id"];
    $type = $_POST["type"];

    if($type == 1){
        $dbh->likePost($postId, $user, $type);
    } else if ($type == -1)
    {
        $dbh->removeLike($postId, 1);
        $res = "rimosso";
    }

    

}


header('Content-Type: application/json');
echo json_encode($res);

?>