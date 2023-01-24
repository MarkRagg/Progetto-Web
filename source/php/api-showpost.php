<?php
require_once("db_config.php");

$post = $dbh->getPosts(3);
/*$result["username"] = $post["author"];
$result["user_image"] = $image["user_image"];
$result["contenuto"]=$post["string"];*/

header("Content-Type: application/json");
echo json_encode($post);

?>