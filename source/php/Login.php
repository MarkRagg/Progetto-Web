<?php
require_once 'db_config.php';

$templateParams["title"] = "Login";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js","../js/login.js");

require '../template/Login-base.php';
?>