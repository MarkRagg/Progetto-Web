<?php

require_once 'db_config.php';



if(isset($templateParams["post_exists"])){
    //$testo = $_POST["post"];
    $error["a"] = $templateParams["post_exists"];
    $error["error"] = false;
    $error["info"] = "Post inserito con successo";

} else {
    $error["info"] = "Errore; Devi essere loggato per poter inserire un post";
    $error["error"] = true;

}

//echo("ciao");

header('Content-Type: application/json');
echo json_encode($error);



?>