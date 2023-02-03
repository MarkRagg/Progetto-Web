<?php

require_once("db_config.php");

if(isset($_SESSION["user_id"]))
{
    $result["user_info"] = $dbh->getUserInfo($_SESSION["user_id"]);
    $result["course_info"] = $dbh->getCourseInfo($result["user_info"]["corso_id"]);
    $uni_id = $dbh->getUniFromCourse($result["course_info"]["corso_id"]);
    $result["uni_info"] = $dbh->getUniInfo($uni_id);
    $result["userid"]= $_SESSION["user_id"];
}

header("Content-Type: application/json");
echo(json_encode($result));

?>