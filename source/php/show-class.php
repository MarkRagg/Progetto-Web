<div class="container mt-2 mb-5">
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="left-column">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <p class="card-title mt-2"><?php echo($templateParams["class_name"]) ?></p>
                        <p class="card-text">Sezione: <?php echo($templateParams["sezione"]) ?></p>
                        <p class="card-text text-justify mb-2">Corso: 
                            <a href="course.php?course_id=<?php echo $templateParams["course_id"] ?>">
                                <?php echo $templateParams["course_name"] ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="middle-column">
                <div class="card border-primary">
                    <div class="card-header text-center">
                        <p class="card-title mb-0">Post <span class="badge bg-primary rounded-pill"><?php echo($templateParams["post_count"]) ?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>