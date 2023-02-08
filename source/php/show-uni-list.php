<?php foreach($templateParams["uni_list"] as $uni): ?>
<div class="container bg-white p-3 rounded-3 my-5">
    <div class="row">
        <a class="col-6 link-primary h1" href="uni.php?uni_id=<?php echo($uni["uni_id"]) ?>">
            <?php echo($uni["nome"]) ?>
        </a>
        <p class="col-3 h2">
            <?php echo($uni["sede"]) ?>
        </p>
        <p class="col-3 h2 justify-self-end">
            Corsi <span class="badge bg-primary rounded-pill"><?php echo($uni["course_count"]) ?></span>
        </p>
    </div>
</div>
<?php endforeach ?>