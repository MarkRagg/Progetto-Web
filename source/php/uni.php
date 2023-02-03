<?php
require_once("db_config.php");

$templateParams["title"] = "University";
$templateParams["name"] = "show-error.php";

if (isset($_GET["uni_id"])) {
    $uni_exists = $dbh->checkValueInDb("universita", "uni_id", $_GET["uni_id"]);
    if ($uni_exists) {
        $uni = $dbh->getUniInfo($_GET["uni_id"]);
        $templateParams["uni_id"] = $uni["uni_id"];
        $templateParams["uni_name"] = $uni["nome"];
        $templateParams["location"] = $uni["sede"];
        $templateParams["course_count"] = $dbh->getCourseCount($uni["uni_id"]);
        $templateParams["courses"] = $dbh->getCoursesFromUni($uni["uni_id"]);
        $templateParams["name"] = "show-uni.php";
    } else {
        $templateParams["errormsg"] = "University not found";
    }
} else {
    $templateParams["errormsg"] = "Missing id";
}

require("../template/base.php");
?>