<?php
require_once("db_config.php");

$post = $dbh->getPosts(10);

header("Content-Type: application/json");
echo json_encode($post);

?>