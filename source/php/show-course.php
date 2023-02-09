<?php
if ($templateParams["course_exists"]) {
    $course_id = $templateParams["course_id"];
    $name = $templateParams["course_name"];
    $year = $templateParams["year"];
    $uni_id = $templateParams["uni_id"];
    $uni_name = $templateParams["uni_name"];
    $class_count = $templateParams["class_count"];
    $subscribed_count = $templateParams["sub_count"];
    $isSubbed = false;
    $subBtnText = "Iscriviti";
    $subBtnClass = "primary";
    if (isset($_SESSION["user_id"])) {
        $isSubbed = $dbh->isUserSubbedToCourse($_SESSION["user_id"], $course_id);
    }
    if ($isSubbed) {
        $subBtnText = "Annulla Iscrizione";
        $subBtnClass = "danger";
    }
    $main = <<<EOD
    <section>
        <div class="container text-center">
            <div class="row">
                <h1 class="col text-light">$name</h1>
            </div>
        </div>
        <div class="container text-center mb-5">
            <div class="row justify-content-center mb-4">
                <button type="button" id="subBtn" class="col-6 btn btn-$subBtnClass">$subBtnText</button>   
            </div>
            <div class="row mb-2">
                <ul class="list-group list-group-horizontal p-0">
                    <li class="list-group-item col-6">Anno scolastico: $year</li>
                    <li class="list-group-item col-6">Università: <a href="uni.php?uni_id=$uni_id">$uni_name</a></li>
                </ul>
            </div>
            <div class="row">
                <ul class="list-group list-group-horizontal p-0">
                    <li class="col-6 list-group-item align-items-center"><a class="link-primary" id="classes" href="#">Esami</a> <span class="badge bg-primary text-light rounded-pill">$class_count</span></li>
                    <li class="col-6 list-group-item align-items-center"><a class="link-primary" id="subscribers" href="#">Iscritti</a> <span class="badge bg-primary text-light rounded-pill">$subscribed_count</span></li>
                </ul>
            </div>
        </div>
    </section>
    EOD;
} else {
    $errormsg = $templateParams["errormsg"];
    $main = <<<EOD
    <section>
        <div class="bg-danger text-white border border-danger-subtle rounded-3 container-md">
            <p class="text-center">$errormsg</p>
        </div>
    </section>
    EOD;
}
echo($main);
?>