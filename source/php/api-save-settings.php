<?php
require_once("db_config.php");

$result["success"] = false;

if(isset($_SESSION["user_id"])) {
  $user_info = $dbh->getUserInfo($_SESSION["user_id"]);
  //code for change the bio
  if(isset($_POST["bio"]) && $_POST["bio"] != $user_info["descrizione"]) {
    $result["success"] = true;
    $dbh->updateBio($_SESSION["user_id"], $_POST["bio"]);
  }
  //code for change profile image
  if(isset($_FILES["img"]) && $_FILES["img"] != null && $_FILES["img"]['name'] != $user_info["user_image"]) {
    list($success, $img) = uploadImage(UPLOAD_DIR, $_FILES["img"]);
    if($success == 1) {
      $result["success"] = true;
      $dbh->setImageToUser($img, $_SESSION["user_id"]);
    }
  }
  //code for change course
  if(isset($_POST["course_id"]) && $_POST["course_id"] != $user_info["corso_id"]) {
    if($_POST["course_id"] != null) {
      $result["success"] = true;
      $dbh->subUserToCourse($_SESSION["user_id"], $_POST["course_id"]);
    } else {
      $result["success"] = true;
      $dbh->subUserToCourse($_SESSION["user_id"], null);
    }
  }
}

header("Content-Type: application/json");
echo(json_encode($result));
?>