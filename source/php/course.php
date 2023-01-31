<?php
require_once 'db_config.php';

$templateParams["title"] = "Corso";
$templateParams["name"] = "show-course.php";
$templateParams["course_exists"] = false;
$templateParams["errormsg"] = "Missing username";
$templateParams["paginaprofilouser"]=$_SESSION["user_id"];

if (isset($_GET["course_id"])) {
    $templateParams["course_exists"] = $dbh->checkValueInDb("corsi", "corso_id", $_GET["course_id"]);
    if ($templateParams["course_exists"]) {
        $course = $dbh->getCourseInfo($_GET["course_id"]);
        $templateParams["course_id"] = $_GET["course_id"];
        $templateParams["course_name"] = $course["nome"];
        $templateParams["year"] = $course["anno"];
        $uni = $dbh->getUniInfo($course["uni_id"]);
        $templateParams["uni_name"] = $uni["nome"];
        $templateParams["uni_id"] = $uni["uni_id"];
        $templateParams["class_count"] = $dbh->getClassCount($templateParams["course_id"]);
        $templateParams["sub_count"] = $dbh->getSubCount($templateParams["course_id"]);
        $templateParams["js"] = array("../js/course-page-list.js", "../js/subscribe.js", "https://unpkg.com/axios/dist/axios.min.js");
    } else {
        $templateParams["errormsg"] = "Course not found";
    }
}

require '../template/base.php'
?>
