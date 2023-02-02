<?php
require_once("db_config.php");
$result["success"] = false;

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    if (isset($_POST["followed_id"])) {
        $followed_id = $_POST["followed_id"];
        if (isset($_POST["action"])) {
            $action = $_POST["action"];
            $isFollowing = $dbh->isUserFollowing($user_id, $followed_id);
            switch ($action) {
                case "follow":
                    $result["success"] = !$isFollowing;
                    if ($result["success"]) {
                        $dbh->addFollower($followed_id, $user_id);
                        // TODO create notification
                    } else {
                        $result["errormsg"] = "Cannot follow already followed user";
                    }
                    break;
                case "unfollow":
                    $result["success"] = $isFollowing;
                    if ($result["success"]) {
                        $dbh->removeFollower($user_id, $followed_id);
                    } else {
                        $result["errormsg"] = "Tried to unfollow not followed user";
                    }
                    break;
                default:
                    $result["errormsg"] = "Uknown action";
                    break;
            }
        } else {
            $result["action"] = "action not set";
        }
    } else {
        $result["errormsg"] = "followed_id not set";
    }
} else {
    $result["errormsg"] = "User not logged";
}

header("Content-Type: application/json");
echo(json_encode($result));
?>