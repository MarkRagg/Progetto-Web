<?php

require_once("db_config.php");

if(isset($_POST['comment']) && isset($_SESSION["user_id"]) && isset($_POST['post_id'])) {
    $query = $dbh->addComment($_POST['comment'], $_POST['post_id'], $_SESSION["user_id"]);
    if ($query) {
        $result = array(
            "status" => "success",
            "message" => "Commento aggiunto con successo"
        );
    } else {
        $result = array(
            "status" => "error",
            "message" => "Errore nell'aggiunta del commento"
        );
    }

} else {
    $result = array(
        "status" => "error",
        "message" => "Errore nell'aggiunta del commento"
    );
}

header("Content-Type: application/json");
echo json_encode($result);

?>