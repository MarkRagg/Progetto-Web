<?php
$isFollowing = false;
$followBtnText = "<em class=\"bi bi-person-plus\"> Segui</em>";
$followBtnClass = "primary";
$followBtnDisable = "";
if (isset($_SESSION["user_id"])) {
    $isFollowing = $dbh->isUserFollowing($_SESSION["user_id"], $templateParams["username"]);
    if ($isFollowing) {
        $followBtnText = "<em class=\"bi bi-person-slash\"> Non seguire</em>";
        $followBtnClass = "danger";
    }
    if ($templateParams["username"] === $_SESSION["user_id"]) {
        $followBtnDisable = "hidden";
    }
}
?>
<div class="container mt-2 mb-5">
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="left-column">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="<?php echo($templateParams["user_image"]) ?>" id="profileImage" widh="120" height="120" class="mt-n5 rounded-circle" alt="immagine profilo"/>
                        <p class="card-title mt-2"><?php echo($templateParams["u_name"]." ".$templateParams["surname"]) ?></p>
                        <p class="card-text">@<?php echo($templateParams["username"]) ?></p>
                        <?php
                            if ($templateParams["corso_id"] !== null) {
                                $courseInfo = $dbh->getCourseInfo($templateParams["corso_id"]);
                                echo ("<p class=\"card-text\">Iscritto a: <a href=\"course.php?course_id=".$courseInfo["corso_id"]."\">".$courseInfo["nome"]."</a></p>");
                            }
                        ?>
                        <p class="card-text text-justify mb-2"><?php echo($templateParams["descrizione"]) ?></p>
                        <p class="card-text text-justify mb-2">Residenza: <?php echo($templateParams["residence"]) ?></p>
                        <p class="card-text text-justify mb-2"><?php echo($templateParams["date_of_birth"]) ?></p>
                        <button type="button" id="followBtn" class="btn btn-<?php echo($followBtnClass)?>" <?php echo($followBtnDisable)?>><?php echo($followBtnText) ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="middle-column">
                <div class="card border-primary">
                    <div class="card-header">
                        <ul class="list-group list-group-horizontal p-0 text-center">
                            <li class="col-4 list-group-item align-items-center"><a class="link-primary" id="posts" href="#">Post</a> <span class="badge bg-primary rounded-pill text-light"><?php echo($templateParams["post_count"]) ?></span></li>
                            <li class="col-4 list-group-item align-items-center"><a class="link-primary" id="followers" href="#">Seguaci</a> <span class="badge bg-primary rounded-pill text-light"><?php echo($templateParams["follower_count"]) ?></span></li>
                            <li class="col-4 list-group-item align-items-center"><a class="link-primary" id="following" href="#">Seguiti</a> <span class="badge bg-primary rounded-pill text-light"><?php echo($templateParams["followed_count"]) ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>