<?php

require_once("db_config.php");

if(isset($_POST["comment_id"]) && isset($_SESSION["user_id"])) {
    if($dbh->checkValueInDb("post", "post_id", $_POST["post_id"])){
        $a = $dbh->removeComment($_POST["comment_id"]);
        header("Content-Type: application/json");
        echo json_encode(array("status" => "success", "message" => "Commento eliminato"));
    }


} else {
    echo json_encode(array("status" => "error", "message" => "Parametri mancanti"));
}

?>