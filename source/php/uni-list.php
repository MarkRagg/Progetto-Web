<?php
require_once("db_config.php");

$templateParams["title"] = "Lista Università";
$templateParams["name"] = "show-uni-list.php";
$templateParams["uni_list"] = $dbh->getAllUnis();
for($i = 0; $i < count($templateParams["uni_list"]); $i++) {
    $curr = $templateParams["uni_list"][$i];
    $templateParams["uni_list"][$i]["course_count"] = $dbh->getCourseCount($curr["uni_id"]);
}
// foreach ($templateParams["uni_list"] as $uni) {
//     $uni["course_count"] = $dbh->getCourseCount($uni["uni_id"]);
// }

require("../template/base.php");
?>