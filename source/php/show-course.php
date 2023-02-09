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
    <div class="container mt-2 mb-5">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="left-column">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <p class="card-title mt-2">$name</p>
                            <p class="card-text text-justify mb-2">Anno scolastico: $year</p>
                            <p class="card-text text-justify mb-2">Università: <a href="uni.php?uni_id=$uni_id">$uni_name</a></p>
                            <button type="button" id="subBtn" class="col-6 btn btn-$subBtnClass">$subBtnText</button>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="middle-column">
                    <div class="card border-primary">
                        <div class="card-header">
                            <ul class="list-group list-group-horizontal p-0">
                                <li class="col-6 list-group-item align-items-center"><a class="link-primary" id="classes" href="#">Esami</a> <span class="badge bg-primary text-light rounded-pill">$class_count</span></li>
                                <li class="col-6 list-group-item align-items-center"><a class="link-primary" id="subscribers" href="#">Iscritti</a> <span class="badge bg-primary text-light rounded-pill">$subscribed_count</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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