<?php
require_once("db_config.php");

$templateParams["title"] = "Notification";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js","../js/notification.js");

require '../template/base.php';
?>