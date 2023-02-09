<section>
    <div class="container text-center p-5">
        <div class="row">
            <h1 class="col text-light"><?php echo($templateParams["class_name"]) ?></h1>
        </div>
        <div class="row bg-white p-3 rounded-3">
            <p class="col text my-0"><?php echo("Sezione: ".$templateParams["sezione"]) ?></p>
            <p class="col text my-0">
                Corso: 
                <a href="course.php?course_id=<?php echo $templateParams["course_id"] ?>">
                    <?php echo $templateParams["course_name"] ?>
                </a>
            </p>
        </div>
    </div>
    <div class="container text-center bg-white p-3 rounded-3">
        <div class="flex-row d-flex justify-content-center align-items-center">
            <p class="col my-0">Post <span class="badge bg-primary rounded-pill"><?php echo($templateParams["post_count"]) ?></span></p>
        </div>
    </div>
</section>