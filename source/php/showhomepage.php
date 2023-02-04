<?php
require_once("db_config.php");

$templateParams["title"]="Homepage";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../js/try.js", "../js/post.js");

require("../template/base.php");
?>