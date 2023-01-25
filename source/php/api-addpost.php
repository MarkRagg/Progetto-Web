<?php

$user = $_SESSION["user_id"];

header("Content-Type: application/json");
echo json_encode($user);

?>