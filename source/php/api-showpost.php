<?php
require_once("db_config.php");

$post = $dbh->getPosts(3);

header("Content-Type: application/json");
echo json_encode($post);

?>