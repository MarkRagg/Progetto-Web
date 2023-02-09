<?php
require_once("db_config.php");

$templateParams["title"]="Homepage";
$templateParams["homepage"] = "link-secondary";
$templateParams["uni-list"] = "";
$templateParams["notifications"] = "";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../js/reactions.js", "../js/post.js");

require("../template/base.php");
?>