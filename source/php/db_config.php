<?php
session_start();
//define("UPLOAD_DIR", "./upload/");
require_once("../database/database.php");
$dbh = new DatabaseManager("localhost", "root", "", "socialnetwork", 3306);
?>