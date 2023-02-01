<?php
    require_once 'db_config.php';

    if($templateParams["post_exists"]){

        
        for ($i = 0; $i < count($templateParams["comments"]); $i++) {
            echo($templateParams["comments"][$i]["comment_id"]);
            echo " ";
            echo($templateParams["comments"][$i]["author"]);
            echo " ";
            echo($templateParams["comments"][$i]["post_id"]);
            echo " ";
            echo($templateParams["comments"][$i]["post_comment"]);
            echo " ";
            echo($templateParams["comments"][$i]["data_commento"]);
        }
        echo($templateParams["numLikes"]);
        
        $commenti = $templateParams["comments"];
        $numLikes = $templateParams["numLikes"];
        $postid = $templateParams["post_id"];
        $autore = $templateParams["author"];
        $data = $templateParams["data"];
        $contenuto = $templateParams["string"];
        $esameid = $templateParams["esame_id"];
    } else {
        echo($templateParams["errormsg"]);
    }



    
    
?>