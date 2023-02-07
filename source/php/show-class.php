<section>
    <div class="container text-center p-5">
        <div class="row">
            <h1 class="col text-light"><?php echo($templateParams["class_name"]) ?></h1>
        </div>
        <div class="row bg-white p-3 rounded-3">
            <h2 class="col text"><?php echo("Sezione: ".$templateParams["sezione"]) ?></h2>
            <h2 class="col text">
                Corso: 
                <a href="course.php?course_id=<?php echo $templateParams["course_id"] ?>">
                    <?php echo $templateParams["course_name"] ?>
                </a>
            </h2>
        </div>
    </div>
    <div class="container text-center bg-white p-3 rounded-3">
        <div class="flex-row d-flex justify-content-center align-items-center">
            <h3 class="col">Post <span class="badge bg-primary rounded-pill"><?php echo($templateParams["post_count"]) ?></span></h3>
        </div>
    </div>
</section>