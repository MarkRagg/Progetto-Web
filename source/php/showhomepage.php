<?php
require_once("db_config.php");

$templateParams["title"]="Homepage";
//$templateParams["name"]="post.php";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../js/post.js");

require("../template/base.php");

?>