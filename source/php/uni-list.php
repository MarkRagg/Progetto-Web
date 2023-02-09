<?php
require_once("db_config.php");

$templateParams["title"] = "Lista Università";
$templateParams["name"] = "show-uni-list.php";
$templateParams["homepage"] = "";
$templateParams["uni-list"] = "link-secondary";
$templateParams["notifications"] = "";
$templateParams["uni_list"] = $dbh->getAllUnis();
for($i = 0; $i < count($templateParams["uni_list"]); $i++) {
    $curr = $templateParams["uni_list"][$i];
    $templateParams["uni_list"][$i]["course_count"] = $dbh->getCourseCount($curr["uni_id"]);
}

require("../template/base.php");
?>