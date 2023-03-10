<?php
require_once("db_config.php");

$templateParams["title"] = "Modifica Post";
$templateParams["homepage"] = "";
$templateParams["uni-list"] = "";
$templateParams["notifications"] = "";

if (isset($_POST["submit"]) && isset($_GET["post_id"]) && isset($_SESSION["user_id"])) {
    $loggedUserId = $_SESSION["user_id"];
    $post_id = $_GET["post_id"];
    $post_exists = $dbh->checkValueInDb("post", "post_id", $post_id);
    if ($post_exists) {
        $postInfo = $dbh->getPost($post_id);
        if ($postInfo["author"] === $loggedUserId) {
            var_dump($_POST);
            if (isset($_POST["delete"]) && $_POST["delete"] === "on") {
                $dbh->removePost($post_id);
                header("Location: profile.php?username=".$loggedUserId);
            } else if ($_POST["post"]){
                switch ($_POST["image"]) {
                    case "sameImage":
                        $dbh->updatePost($post_id, $loggedUserId, $_POST["post"], $postInfo["data"], $postInfo["esame_id"], $postInfo["immagine"]);
                        break;
                    case "deleteImage":
                        $dbh->updatePost($post_id, $loggedUserId, $_POST["post"], $postInfo["data"], $postInfo["esame_id"], null);
                        break;
                    case "changeImage":
                        if (isset($_FILES["imgpost"]) && $_FILES["imgpost"]["name"] != "") {
                            list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["imgpost"]);
                            if($result == 1) {
                                $dbh->updatePost($post_id, $loggedUserId, $_POST["post"], $postInfo["data"], $postInfo["esame_id"], $msg);
                            } else {
                                $templateParams["name"] = "show-error.php";
                                $templateParams["errormsg"] = $msg;
                            }
                        } else {
                            $templateParams["name"] = "show-error.php";
                            $templateParams["errormsg"] = "Immagine mancante.";
                        }
                        break;
                    default:
                        $templateParams["name"] = "show-error.php";
                        $templateParams["errormsg"] = "Opzione immagine non riconosciuta.";
                        break;
                }
                header("Location: post-comment.php?post_id=".$post_id);
            } else {
                $templateParams["name"] = "show-error.php";
                $templateParams["errormsg"] = "Il testo di un post non puo' essere nullo.";
            }
        } else {
            $templateParams["name"] = "show-error.php";
            $templateParams["errormsg"] = "L'utente loggato non e' l'autore del post.";
        }
    } else {
        $templateParams["name"] = "show-error.php";
        $templateParams["errormsg"] = "Post non trovato.";
    }
} else if (isset($_GET["post_id"]) && isset($_SESSION["user_id"])) {
    $loggedUserId = $_SESSION["user_id"];
    $post_id = $_GET["post_id"];
    $post_exists = $dbh->checkValueInDb("post", "post_id", $post_id);
    if ($post_exists) {
        $postInfo = $dbh->getPost($post_id);
        if ($postInfo["author"] === $loggedUserId) {
            $templateParams["post_info"] = $postInfo;
            $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../js/modify-post.js");
            $templateParams["name"] = "show-modify-post.php";
        } else {
            $templateParams["name"] = "show-error.php";
            $templateParams["errormsg"] = "L'utente loggato non e' l'autore del post.";
        }
    } else {
        $templateParams["name"] = "show-error.php";
        $templateParams["errormsg"] = "Post non trovato.";
    }
} else {
    $templateParams["name"] = "show-error.php";
    $templateParams["errormsg"] = "Utente non loggato o id del post non presente.";
}
require '../template/base.php';
?>