<?php
require_once("db_config.php");

if (isset($_POST["searchTerm"])) {
    if ($_POST["searchTerm"] == "") {
        $result["users"] = array();
    } else {
        $result["users"] = $dbh->getSearchResult($_POST["searchTerm"]);
    }
    $result["success"] = true;
} else {
    $result["success"] = false;
}

header("Content-Type: application/json");
echo(json_encode($result));
?>