<?php
if ($templateParams["user_exists"]) {
    $name = $templateParams["u_name"];
    $username = $templateParams["username"];
    $surname = $templateParams["surname"];
    $user_image = $templateParams["user_image"];
    $date_of_birth = $templateParams["date_of_birth"];
    $residence = $templateParams["residence"];
    $corso = $templateParams["corso_id"];
    $user_image = $templateParams["user_image"];
    $post_count = $templateParams["post_count"];
    $follower_count = $templateParams["follower_count"];
    $followed_count = $templateParams["followed_count"];
    $main = <<<EOD
    <section>
        <div class="container">
            <img src="$user_image" alt="immagine profilo"/>
        </div>
        <div class="container text-center">
            <div class="row">
                <h1 class="col">$name $surname</h1>
            </div>
            <div class="row">
                <h2 class="col text-muted">$username</h2>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item col-6 h3">Data di nascita: $date_of_birth</li>
                    <li class="list-group-item col-6 h3">Residenza: $uni_residence</li>
                </ul>
            </div>
            <div class="row">
                <ul class="list-group list-group-horizontal">
                    <li class="col-4 list-group-item align-items-center h4"><a id="posts" href="#">Post</a> <span class="badge bg-primary rounded-pill">$post_count</span></li>
                    <li class="col-4 list-group-item align-items-center h4"><a id="followers" href="#">Seguaci</a> <span class="badge bg-primary rounded-pill">$follower_count</span></li>
                    <li class="col-4 list-group-item align-items-center h4"><a id="following" href="#">Seguiti</a> <span class="badge bg-primary rounded-pill">$followed_count</span></li>
                </ul>
            </div>
        </div>
        <script src="../js/user-list.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js">
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