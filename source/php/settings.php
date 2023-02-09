<?php
require_once("db_config.php");

$templateParams["title"] = "Settings";
$templateParams["homepage"] = "";
$templateParams["uni-list"] = "";
$templateParams["notifications"] = "";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../js/settings.js");

require("../template/base.php");
?>