<?php
require_once("db_config.php");
$query_result = $dbh->AddUser($_POST["nickname"], $_POST["email"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["residence"]);

?>