<?php
session_start();
define("UPLOAD_DIR", "../img/");
require_once("../utils/function.php");
require_once("../database/database.php");
$dbh = new DatabaseManager("localhost", "root", "", "socialnetwork", 3306);
?>