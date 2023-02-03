<?php foreach($templateParams["uni_list"] as $uni): ?>
<div class="container bg-white p-3 rounded-3 mt-3">
    <div class="flex-row d-flex justify-content-between align-items-center">
        <a class="col" href="uni.php?uni_id=<?php echo($uni["uni_id"]) ?>">
            <h1><?php echo($uni["nome"]) ?></h1>
        </a>
        <p class="col">
            <h2>Sede: <?php echo($uni["sede"]) ?></h2>
        </p>
        <p class="col">
            <h2>Corsi <span class="badge bg-primary rounded-pill"><?php echo($uni["course_count"]) ?></span></h2>
        </p>
    </div>
</div>
<?php endforeach ?>