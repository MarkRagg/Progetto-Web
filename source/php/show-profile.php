<?php
$isFollowing = false;
$followBtnText = "Segui";
$followBtnClass = "primary";
$followBtnDisable = "";
$courseInfo = $dbh->getCourseInfo($templateParams["corso_id"]);
if (isset($_SESSION["user_id"])) {
    $isFollowing = $dbh->isUserFollowing($_SESSION["user_id"], $templateParams["username"]);
    if ($isFollowing) {
        $followBtnText = "Non seguire";
        $followBtnClass = "danger";
    }
    if ($templateParams["username"] === $_SESSION["user_id"]) {
        $followBtnDisable = "disabled";
    }
}
?>
<section>
    <div class="container my-5">
        <div class="row flex-row align-items-center justify-content-center text-center">
            <div class="col-6">
                <img src="<?php echo($templateParams["user_image"]) ?>" id="profileImage" class="img-fluid rounded-circle" alt="immagine profilo"/>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <h1 class="col text-light"><?php echo($templateParams["u_name"]." ".$templateParams["surname"]) ?></h1>
        </div>
        <div class="row">
            <h2 class="col text-light"><?php echo($templateParams["username"]) ?></h2>
        </div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-center mb-4">
            <button type="button" id="followBtn" class="col-6 btn btn-<?php echo($followBtnClass)?> <?php echo($followBtnDisable)?>"><?php echo($followBtnText) ?></button>   
        </div>
        <div class="row p-0">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col h3">Data di nascita: <?php echo($templateParams["date_of_birth"]) ?></li>
                <li class="list-group-item col h3">Residenza: <?php echo($templateParams["residence"]) ?></li>
                <?php 
                if ($templateParams["corso_id"] !== NULL) {
                    echo("<li class=\"list-group-item col h3\">Corso: <a href=\"course.php?course_id=".$courseInfo["corso_id"]."\">".$courseInfo["nome"]."</a></li>");
                }
                ?>
            </ul>
        </div>
        <div class="row p-0 mb-5">
            <ul class="list-group list-group-horizontal">
                <li class="col-4 list-group-item align-items-center h4"><a class="link-primary" id="posts" href="#">Post</a> <span class="badge bg-primary rounded-pill text-light"><?php echo($templateParams["post_count"]) ?></span></li>
                <li class="col-4 list-group-item align-items-center h4"><a class="link-primary" id="followers" href="#">Seguaci</a> <span class="badge bg-primary rounded-pill text-light"><?php echo($templateParams["follower_count"]) ?></span></li>
                <li class="col-4 list-group-item align-items-center h4"><a class="link-primary" id="following" href="#">Seguiti</a> <span class="badge bg-primary rounded-pill text-light"><?php echo($templateParams["followed_count"]) ?></span></li>
            </ul>
        </div>
    </div>
</section>