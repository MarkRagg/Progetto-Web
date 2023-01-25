<?php
require_once("db_config.php");

$result["success"] = false;

if(isset($_POST["profileUsername"]) && isset($_POST["requestedList"])) {
    $profileUsername = $_POST["profileUsername"];
    $requestedList = $_POST["requestedList"];
    switch($requestedList) {
        case "followers":
            $result["success"] = true;
            $followers = $dbh->getFollowers($profileUsername);
            for($i = 0; $i < count($followers); $i++) {
                $followerInfo = $dbh->getUserInfo($followers[$i]["follower_id"]);
                $followers[$i] = array_merge($followers[$i], $followerInfo);
            }
            $result["userList"] = $followers;
            $result["requestedList"] = $requestedList;
            break;
        case "following":
            $result["success"] = true;
            $following = $dbh->getFollowing($profileUsername);
            for($i = 0; $i < count($following); $i++) {
                $followingInfo = $dbh->getUserInfo($following[$i]["user_id"]);
                $following[$i] = array_merge($following[$i], $followingInfo);
            }
            $result["userList"] = $following;
            $result["requestedList"] = $requestedList;
            break;
        default:
            $result["errormsg"] = "Requested list uknown";
            break;
    }
} else {
    $result["errormsg"] = "Missing required data";
}

header("Content-Type: application/json");
echo(json_encode($result));

?>