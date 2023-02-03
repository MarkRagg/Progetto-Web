<?php

require_once("db_config.php");
define("REACTION", 2);

$res =" ok ";



if (isset($_POST["post_id"]) && isset($_SESSION["user_id"]) && isset($_POST["type"])) {
    $postId = $_POST["post_id"];
    $user = $_SESSION["user_id"];
    $type = $_POST["type"];

    if($type > 0){
        $dbh->likePost($postId, $user, $type);
        $author = $dbh->getPost($_POST['post_id'])['author'];
        if($author != $_SESSION['user_id']) {
            $dbh->addNotification($_SESSION['user_id'], $author, $_POST['post_id'], REACTION);
        }
    } else if ($type < 0) {
        $dbh->removeLike($postId, -$type, $user);
        $res = "rimosso".$type;
    }

    

}


header('Content-Type: application/json');
echo json_encode($res);

?>