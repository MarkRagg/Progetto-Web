<section class="mb-5">
    <div class="container text-center p-5">
        <div class="row">
            <h1 class="col text-light"><?php echo($templateParams["uni_name"]) ?></h1>
        </div>
        <div class="row">
            <p class="col text-light fs-3"><?php echo("Sede: ".$templateParams["location"]) ?></p>
        </div>
    </div>
    <div class="container text-center bg-white p-3 rounded-3">
        <div class="flex-row d-flex justify-content-center align-items-center">
            <p class="col text-primary fs-3">Corsi <span class="badge bg-primary rounded-pill"><?php echo($templateParams["course_count"]) ?></span></p>
        </div>
    </div>
    <?php foreach($templateParams["courses"] as $course): ?>
    <div class="container bg-white p-3 rounded-3 my-3">
        <div class="flex-row d-flex justify-content-between align-items-center">
            <a class="col-9" href="course.php?course_id=<?php echo($course["corso_id"]) ?>">
                <?php echo($course["nome"]) ?>
            </a>
            <p class="col-3 text-center">
                Anno: <?php echo($course["anno"]) ?>
            </p>
        </div>
    </div>
    <?php endforeach ?>
</section>