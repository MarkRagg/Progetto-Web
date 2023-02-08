<section class="mb-5">
    <div class="container text-center p-5">
        <div class="row">
            <h1 class="col text-light"><?php echo($templateParams["uni_name"]) ?></h1>
        </div>
        <div class="row">
            <h2 class="col text-light"><?php echo("Sede: ".$templateParams["location"]) ?></h2>
        </div>
    </div>
    <div class="container text-center bg-white p-3 rounded-3">
        <div class="flex-row d-flex justify-content-center align-items-center">
            <h3 class="col text-primary">Corsi <span class="badge bg-primary rounded-pill"><?php echo($templateParams["course_count"]) ?></span></h3>
        </div>
    </div>
    <?php foreach($templateParams["courses"] as $course): ?>
    <div class="container bg-white p-3 rounded-3 my-3">
        <div class="flex-row d-flex justify-content-between align-items-center">
            <a class="col" href="course.php?course_id=<?php echo($course["corso_id"]) ?>">
                <h4><?php echo($course["nome"]) ?></h4>
            </a>
            <p class="col">
                <h5>Anno: <?php echo($course["anno"]) ?></h5>
            </p>
        </div>
    </div>
    <?php endforeach ?>
</section>