<?php
require_once("db_config.php");

$result["success"] = false;

if (isset($_POST["courseId"]) && isset($_POST["requestedList"])) {
    $courseId = $_POST["courseId"];
    $requestedList = $_POST["requestedList"];
    switch($requestedList) {
        case "classes":
            $result["success"] = true;
            $result["classes"] = $dbh->getClassesFromCourse($courseId);
            break;
        case "subscribers":
            $result["success"] = true;
            $result["subscribers"] = $dbh->getSubsFromCourse($courseId);
            break;
        default:
            $result["errormsg"] = "Required list uknown";
            break;
    }
} else {
    $result["errormsg"] = "Missing required request data";
}

header("Content-Type: application/json");
echo(json_encode($result));
?>