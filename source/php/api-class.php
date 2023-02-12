<?php
require_once("db_config.php");

$result["success"] = false;

if (isset($_POST["class_id"]) && isset($_SESSION["user_id"])) {
    $class_id = $_POST["class_id"];
    if ($dbh->checkValueInDb("esami", "esame_id", $_POST["class_id"])) {
        $classInfo = $dbh->getClassInfo($class_id);
        $result["posts"] = $dbh->getPostsFromClass($class_id);
        for ($i = 0; $i < count($result["posts"]); $i++) {
            $post_id = $result["posts"][$i]["post_id"];
            $author = $dbh->getUserInfo($result["posts"][$i]["author"]);
            $reactions = $dbh->getAllReactionCount($post_id);
            $userReactions = $dbh->hasReactedAll($_SESSION["user_id"], $post_id);
            $result["posts"][$i]["data"] = date("F j, Y", strtotime($result["posts"][$i]["data"]));
            $result["posts"][$i]["num_comments"] = $dbh->getPostComments($post_id);
            $result["posts"][$i] = array_merge($result["posts"][$i], $author);
            $result["posts"][$i] = array_merge($result["posts"][$i], $reactions);
            $result["posts"][$i] = array_merge($result["posts"][$i], $userReactions);
            $result["posts"][$i] = array_merge($result["posts"][$i], $classInfo);
        }
        $result["success"] = true;
    } else {
        $result["errormsg"] = "Class not found";
    }
} else {
    $result["errormsg"] = "User not logged or class id missing";
}
header("Content-Type: application/json");
echo(json_encode($result));
?>