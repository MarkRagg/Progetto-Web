<?php
require_once("db_config.php");

$post = $dbh->getPostFromUser("io")[0];
$image = $dbh->getUserInfo("io")[0];
$result["username"] = $post["author"];
$result["user_image"] = $image["user_image"];
$result["contenuto"]=$post["string"];

header("Content-Type: application/json");
echo json_encode($result);

?>