<?php
require_once("db_config.php");
$query_result = $dbh->Login($_POST["email"], $_POST["password"]);
var_dump($query_result);
if(!empty($query_result)) {
  echo "Loggato";
} else {
  echo "Sessione fallita";
}
?>