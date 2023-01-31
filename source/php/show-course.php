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
        $isSubbed = $dbh->isUserSubbed($_SESSION["user_id"], $course_id);
    }
    if ($isSubbed) {
        $subBtnText = "Annulla Iscrizione";
        $subBtnClass = "Light";
    }
    $main = <<<EOD
    <section>
        <div class="container text-center">
            <div class="row">
                <h1 class="col text-light">$name</h1>
            </div>
            <div class="row">
                <h2 class="col text-light">$course_id</h2>
            </div>
        </div>
        <div class="container text-center">
            <div class="row justify-content-center">
                <button type="button" id="subBtn" class="col-6 btn btn-$subBtnClass">$subBtnText</button>   
            </div>
            <div class="row">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item col-6 h3">Anno scolastico: $year</li>
                    <li class="list-group-item col-6 h3">Università: <a href="#">$uni_name</a></li>
                </ul>
            </div>
            <div class="row">
                <ul class="list-group list-group-horizontal">
                    <li class="col-6 list-group-item align-items-center h4"><a class="link-dark" id="classes" href="#">Esami</a> <span class="badge bg-dark rounded-pill">$class_count</span></li>
                    <li class="col-6 list-group-item align-items-center h4"><a class="link-dark" id="subscribers" href="#">Iscritti</a> <span class="badge bg-dark rounded-pill">$subscribed_count</span></li>
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
            <h1 class="text-center">$errormsg</h1>
        </div>
    </section>
    EOD;
}
echo($main);
?>