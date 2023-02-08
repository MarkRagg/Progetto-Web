<?php
require_once("db_config.php");

$result["success"] = false;

if (isset($_POST["profileUsername"])) {
    $username = $_POST["profileUsername"];
    $nameCheck = $dbh->checkValueInDb("user", "user_id", $username);
    if ($nameCheck) {
        $result["success"] = true;
        $result["userPosts"] = $dbh->getAllUserPosts($username);
        $authorInfo = $dbh->getUserInfo($username);
        for ($i = 0; $i < count($result["userPosts"]); $i++) {
            $id = $result["userPosts"][$i]["post_id"];
            if ($result["userPosts"][$i]["esame_id"]) {
                $class = $dbh->getClassInfo($result["userPosts"][$i]["esame_id"]);
                $result["userPosts"][$i] = array_merge($result["userPosts"][$i], $class);
            }
            $reactCount = $dbh->getAllReactionCount($id);
            $userReactions = $dbh->hasReactedAll($_SESSION["user_id"], $id);
            $result["userPosts"][$i]["user_image"] = $authorInfo["user_image"];
            $result["userPosts"][$i] = array_merge($result["userPosts"][$i], $reactCount);
            $result["userPosts"][$i] = array_merge($result["userPosts"][$i], $userReactions);
            $result["userPosts"][$i]["num_comments"] = $dbh->getPostComments($id);
        }
    } else {
        $result["errormsg"] = "User not found";
    }
} else {
    $result["errormsg"] = "Missing username";
}

header("Content-Type: application/json");
echo(json_encode($result));
?>