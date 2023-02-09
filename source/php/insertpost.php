<?php
require_once("db_config.php");

$templateParams["title"] = "Insert Post";
$templateParams["name"] = "../template/form_add_post.php";
$templateParams["homepage"] = "link-secondary";
$templateParams["uni-list"] = "";
$templateParams["notifications"] = "";
$templateParams["paginaprofilouser"]= $_SESSION["user_id"];

$error = "";

if(isset($_POST["submit"]) && isset($_POST["post"])){
    $testo = $_POST["post"];
    if ($testo != "" && isset($_SESSION["user_id"])) {
        if(isset($_FILES["imgpost"]) && $_FILES["imgpost"]["name"] != ""){
            list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["imgpost"]);
            if($result == 1){
                $dbh->addPost($testo, $_SESSION["user_id"], $msg);
                header("Location: showhomepage.php");
            } else {
                $error = $msg;
            }
        } else {
            $dbh->addPost($testo, $_SESSION["user_id"], null);
            header("Location: showhomepage.php");
        }
        
        //$dbh->addPost($testo, $_SESSION["user_id"]);
        
        //echo($result);
        
    } else if($testo == ""){
        $error = "Errore; Il testo non può essere vuoto";
    } else {
        $error = "Errore; Devi essere loggato per poter inserire un post";
    }
}

require '../template/base.php';
?>