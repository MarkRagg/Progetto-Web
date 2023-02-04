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
    <?php foreach($templateParams["posts"] as $post): ?>
    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="d-flex justify-content-between p-2 px-3">
                        <div class="d-flex flex-row align-items-center"> <img src="<?php echo UPLOAD_DIR.$post["user_image"] ?>" width="50" class="rounded-circle">
                            <div class="d-flex flex-column ml-2">
                                <a class="nav-link" href="profile.php?username=<?php echo $post["author"] ?>"><?php echo $post["name"]." ".$post["surname"]." @".$post["author"] ?></a> 
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2"><?php echo $post["data"] ?></small> <i class="fa fa-ellipsis-h"></i> </div>
                    </div>
                    <div class="p-2">
                        <p class="text-justify"><?php echo $post["string"] ?></p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row muted-color">
                            <button id="bottone">Like</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</section>