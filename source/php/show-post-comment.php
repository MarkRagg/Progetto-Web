    <div class="container mt-2 mb-5">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="left-column">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="middle-column">
                    <div class="card border-primary">
                        <div class="card-header">
                            <h4 class="card-title text-center">Discussione</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-2 px-3">
                                <div class="d-flex flex-row align-items-center"> <img id="imgProfile"
                                        src="https://www.w3schools.com/html/workplace.jpg" width="50"
                                        class="rounded-circle" alt="">
                                    <div class="d-flex flex-column ml-2"> <a class="nav-link"
                                            href="profile.php?username=<?php echo $templateParams["author"];?>">@<?php echo $templateParams["author"];?></a>
                                        <small class="text-primary"><?php echo $templateParams["esame_id"];?></small>
                                    </div>

                                </div>
                                <div class="d-flex flex-row mt-1 ellipsis"> <small
                                        class="mr-2"><?php echo $templateParams["data"];?></small> <em
                                        class="fa fa-ellipsis-h"></em>
                                </div>
                            </div>
                            <div class="px-4 mt-3 mb-3">
                                <p class="text-justify"><?php echo $templateParams["string"];?>.</p>
                            </div>
                            <div class="d-flex align-items-center mt-4">
                                <button id="bottoneLikePost"
                                    class="bottone btn btn-outline-danger position-relative me-5 ms-5 btn-sm">Like
                                    <span
                                        class="numeroLike position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                        id="numeroLikePost">
                                        <?php echo $templateParams["numLikes"];?>
                                    </span>
                                </button>
                                <a href="../php/post-comment.php?post_id=<?php echo $templateParams["post_id"];?>"
                                    class="comlink">Commenta</a>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group">
                            <input type="text" class="quickpost form-control mx-1" placeholder="Commenta">
                            <div class="input-group-append">
                                <button type="submit" class="bttnpost btn btn-primary mx-2">Commenta</button>
                            </div>
                        </div>
                        <?php foreach ($templateParams["comments"] as $commento): ?>
                        <hr />
                        <div class="d-flex justify-content-between p-2 px-3">
                            <div class="d-flex flex-row align-items-center"> <img id="imgProfile"
                                    src="https://www.w3schools.com/html/workplace.jpg" width="30" class="rounded-circle"
                                    alt="">
                                <div class="d-flex flex-column ml-2"> <a class="nav-link"
                                        href="profile.php?username=<?php echo $commento["author"];?>">@<?php echo $commento["author"];?></a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mt-1 ellipsis"> <small
                                    class="mr-2"><?php echo date("F j, Y", strtotime($commento["data_commento"]));?></small> <em
                                    class="fa fa-ellipsis-h"></em>
                            </div>
                        </div>
                        <div class="px-4 mt-3 mb-3">
                            <p class="text-justify"><?php echo $commento["post_comment"];?>.</p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>