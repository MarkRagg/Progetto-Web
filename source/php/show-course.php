<?php
$isSubbed = false;
$hideSubBtn = false;
$subBtnText = "Iscriviti";
$subBtnClass = "primary";
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $hideSubBtn =  $dbh->isUserSubbed($user_id) && ($dbh->getCourseFromUser($user_id) != $templateParams["course_id"]);
    if (!$hideSubBtn) {
        $isSubbed = $dbh->isUserSubbedToCourse($_SESSION["user_id"], $templateParams["course_id"]);
    }
}
if ($isSubbed) {
    $subBtnText = "Annulla Iscrizione";
    $subBtnClass = "danger";
}
?>
<div class="container mt-2 mb-5">
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="left-column">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <p class="card-title mt-2"><?php echo($templateParams["course_name"]) ?></p>
                        <p class="card-text text-justify mb-2">Anno scolastico: <?php echo($templateParams["year"]) ?></p>
                        <p class="card-text text-justify mb-2">Università: <a href="uni.php?uni_id=<?php echo($templateParams["uni_id"]) ?>"><?php echo($templateParams["uni_name"]) ?></a></p>
                        <button type="button" id="subBtn" class="col-6 btn btn-<?php echo($subBtnClass) ?>" <?php if($hideSubBtn) echo("hidden"); ?>><?php echo($subBtnText) ?></button>   
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="middle-column">
                <div class="card border-primary">
                    <div class="card-header">
                        <ul class="list-group list-group-horizontal p-0">
                            <li class="col-6 list-group-item align-items-center"><a class="link-primary" id="classes" href="#">Esami</a> <span class="badge bg-primary text-light rounded-pill"><?php echo($templateParams["class_count"]) ?></span></li>
                            <li class="col-6 list-group-item align-items-center"><a class="link-primary" id="subscribers" href="#">Iscritti</a> <span class="badge bg-primary text-light rounded-pill"><?php echo($templateParams["sub_count"]) ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>