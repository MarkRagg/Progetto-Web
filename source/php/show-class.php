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
        <?php $i = 0; ?>
        <div class="container mb-5">
            <div class="row flex-row d-flex justify-content-center align-items-center bg-white p-3 m-3 rounded-3">
                <div class="col d-flex justify-content-between p-2 px-3">
                    <div class="d-flex flex-row align-items-center">
                        <img src="<?php echo(UPLOAD_DIR.$post["user_image"]) ?>" width="50" class="rounded-circle" alt="">
                        <div class="d-flex flex-column ml-2">
                            <a class="nav-link" href="profile.php?username=<?php echo($post["author"]) ?>">@<?php echo($post["author"]) ?></a>
                            <?php
                                if ($post["esame_id"]) {
                                    echo("<a href=\"class.php?class_id=".$post["esame_id"]."\">".$templateParams["class_name"]."</a>");
                                }
                            ?>
                        </div>
                    </div>
                    <div class="d-flex flex-row mt-1 ellipsis">
                        <small class="mr-2">
                            <?php
                                $date = date_create($post["data"]);
                                echo(date_format($date, "F j, Y"));
                            ?>
                        </small>
                        <em class="fa fa-ellipsis-h"></em>
                    </div>
                    </div>
                    <div class="px-4 mt-3 mb-3">
                        <?php
                            if ($post["immagine"]) {
                                echo("<img src=\"".UPLOAD_DIR.$post["immagine"]."\" alt=\"\" class=\"img-fluid\">");
                            }
                        ?>
                <p class="text-justify"><?php echo($post["string"]) ?></p>
              </div>
              <div class="d-flex align-items-center mt-4">
                <button id="bottoneLikePost<?php echo($i) ?>" class="bottone bottoneL btn btn-outline-danger position-relative me-2 ms-4 "><em class="bi bi-hand-thumbs-up"></em>
                  <span class="numeroLike position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroLikePost<?php echo($i) ?>">
                    <?php echo($post["num_like"]) ?>
                  </span>
                </button>

                <button id="bottoneCommentPost<?php echo($i) ?>" class="btn btn-outline-danger position-relative me-2 ms-2" onclick="<?php echo("location.href='../php/post-comment.php?post_id=".$post["post_id"]."';"); ?>"><em class="bi bi-chat-left-text-fill"></em>
                  <span class="numeroCommento position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroCommentiPost<?php echo($i) ?>">
                    <?php echo($post["num_comments"]) ?>
                  </span>
                </button>

                <button id="bottoneFirePost<?php echo($i) ?>" class="btnFire btnFireL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-fire"></em>
                  <span class="numeroFire position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroFirePost<?php echo($i) ?>">
                    <?php echo($post["num_fire"]) ?>
                  </span>
                </button>

                <button class="btnSmile btnSmileL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-emoji-smile-upside-down"></em>
                  <span class="numeroSmile position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroSmilePost<?php echo($i) ?>">
                    <?php echo($post["num_smile"]) ?>
                  </span>
                </button>

                <button class="btnCuore btnCuoreL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-heart-fill"></em>
                  <span class="numeroCuore position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroCuoriPost<?php echo($i) ?>">
                    <?php echo($post["num_cuore"]) ?>
                  </span>
                </button>
                <button  class="btnBacio btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-emoji-kiss"></em>
                  <span class="numeroBacio position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroBaciPost<?php echo($i) ?>">
                    <?php echo($post["num_baci"]) ?>
                  </span>
                </button>
              </div>
            </div>
            </div>
            <?php $i++; ?>
    <?php endforeach ?>
</section>