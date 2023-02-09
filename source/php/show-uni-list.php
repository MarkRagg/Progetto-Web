<?php foreach($templateParams["uni_list"] as $uni): ?>
<div class="container bg-white p-3 rounded-3 my-5">
    <div class="row flex align-items-center">
        <a class="col-6 link-primary" href="uni.php?uni_id=<?php echo($uni["uni_id"]) ?>">
            <?php echo($uni["nome"]) ?>
        </a>
        <p class="col-3 text-center">
            <?php echo($uni["sede"]) ?>
        </p>
        <p class="col-3 text-center justify-self-end">
            Corsi <span class="badge bg-primary rounded-pill"><?php echo($uni["course_count"]) ?></span>
        </p>
    </div>
</div>
<?php endforeach ?>