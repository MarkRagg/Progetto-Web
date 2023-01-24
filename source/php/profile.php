<?php
require_once 'db_config.php';

$templateParams["title"] = "Profile";
//$templateParams["name"] = "profile-template.php";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../js/profile.js");

require '../template/base.php'
?>