<?php
require_once("db_config.php");
$result["success"] = false;
$result["errormsg"] = "User not logged";

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    if (isset($_POST["course_id"])) {
        $course_id = $_POST["course_id"];
        if (isset($_POST["action"])) {
            $action = $_POST["action"];
            $isSubbed = $dbh->isUserSubbed($user_id);
            switch ($action) {
                case "subscribe":
                    if (!$isSubbed) {
                        if ($dbh->checkValueInDb("corsi", "corso_id", $course_id)) {
                            $result["success"] = $dbh->subUserToCourse($user_id, $course_id);
                        } else {
                            $result["errormsg"] = "Course not found";
                        }
                    } else {
                        $result["errormsg"] = "User already subscribed";
                    }
                    break;
                case "unsubscribe":
                    if ($isSubbed) {
                        if ($dbh->checkValueInDb("corsi", "corso_id", $course_id)) {
                            $result["success"] = $dbh->unsubUserFromCourse($user_id, $course_id);
                        } else {
                            $result["errormsg"] = "Course not found";
                        }
                    } else {
                        $result["errormsg"] = "User is not subscribed";
                    }
                    break;
                default:
                    $result["errormsg"] = "Uknown action";
                    break;
            }
        } else {
            $result["errormsg"] = "action not set";
        }
    } else {
        $result["errormsg"] = "course_id not set";
    }
}

header("Content-Type: application/json");
echo(json_encode($result));
?>