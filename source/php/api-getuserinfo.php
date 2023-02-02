<?php

require_once("db_config.php");

if(isset($_SESSION["user_id"]))
{
    $result = $dbh->getUserInfo($_SESSION["user_id"]);
    $result["userid"]= $_SESSION["user_id"];
}

header("Content-Type: application/json");
echo(json_encode($result));

?>