<?php
require_once("db_config.php");

$error["error"] = true;

if(isset($_POST["post"])){
    $testo = $_POST["post"];
    if ($testo != "" && isset($_SESSION["user_id"])) {
        $dbh->addPost($testo, $_SESSION["user_id"], null);
        $error["error"] = false;
        $error["info"] = "Post inserito con successo";
    } else {
        $error["info"] = "Errore; Devi essere loggato per poter inserire un post";
        $error["error"] = true;

    }
}


header("Content-Type: application/json");
echo (json_encode($error));

?>