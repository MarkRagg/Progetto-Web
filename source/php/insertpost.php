<?php
require_once("db_config.php");

$templateParams["title"] = "Insert Post";
$templateParams["name"] = "../template/form_add_post.php";
$templateParams["paginaprofilouser"]= $_SESSION["user_id"];

$testo = $_POST["post"];

if(isset($_POST["submit"])){
    if ($testo != "" && isset($_SESSION["user_id"])) {
        $dbh->addPost($testo, $_SESSION["user_id"]);
        header("Location: showhomepage.php");
    } else if($testo == ""){
        $error = "Errore; Il testo non può essere vuoto";
    } else {
        $error = "Errore; Devi essere loggato per poter inserire un post";
    }
}

require '../template/base.php';
?>