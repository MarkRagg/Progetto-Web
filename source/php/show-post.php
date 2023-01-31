<?php
    require_once 'db_config.php';
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
    echo($templateParams["numLikes"])
?>