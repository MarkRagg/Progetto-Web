<?php
require_once("db_config.php");

$templateParams["title"] = "Course";
$templateParams["name"] = "show-error.php";

if (isset($_GET["class_id"])) {
    $class_exists = $dbh->checkValueInDb("esami", "esame_id", $_GET["class_id"]);
    if ($class_exists) {
        $class = $dbh->getClassInfo($_GET["class_id"]);
        $templateParams["class_id"] = $class["esame_id"];
        $templateParams["class_name"] = $class["nome"];
        $templateParams["course_id"] = $class["corso_id"];
        $templateParams["sezione"] = $class["sezione"];
        $course = $dbh->getCourseInfo($class["corso_id"]);
        $templateParams["course_name"] = $course["nome"];
        $templateParams["year"] = $course["anno"];
        $templateParams["uni_id"] = $course["uni_id"];
        $uni = $dbh->getUniInfo($templateParams["uni_id"]);
        $templateParams = array_merge($templateParams, $uni);
        $templateParams["post_count"] = $dbh->getPostCountFromClass($templateParams["class_id"]);
        $templateParams["posts"] = $dbh->getPostsFromClass($templateParams["class_id"]);
        for ($i = 0; $i < count($templateParams["posts"]); $i++) {
            $author = $dbh->getUserInfo($templateParams["posts"][$i]["author"]);
            $templateParams["posts"][$i] = array_merge($templateParams["posts"][$i], $author);
        }
        $templateParams["name"] = "show-class.php";
    } else {
        $templateParams["errormsg"] = "Class not found";
    }
} else {
    $templateParams["errormsg"] = "Missing id";
}

require("../template/base.php");
?>