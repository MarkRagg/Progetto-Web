<?php

$user = $_SESSION["user_id"];
$templateParams["title"] = "Create a new post";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js","../js/postform.js");

require '../template/Login-base.php';
?>