<?php
require_once 'db_config.php';

//Base Template
$templateParams["title"] = "Sign-in";
$templateParams["name"] = "template-Sign-in.php";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js","../js/sign-in.js");

require '../template/Login-base.php';
?>