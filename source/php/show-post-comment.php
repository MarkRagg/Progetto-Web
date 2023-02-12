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
                            <p class="card-title text-center">Discussione</p>
                        </div>
                        <?php if ($templateParams["post_exists"]){ ?>
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-2 px-3">
                                <div class="d-flex flex-row align-items-center"> <img id="imgProfile"
                                        src="<?php echo ("../img/".$templateParams["user_img"]);?>" width="50"
                                        class="rounded-circle" alt="immagine profilo">
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
                                <img src="../img/<?php echo $templateParams["immagine"];?>" alt="" class="img-fluid">
                                <p class="text-justify"><?php echo $templateParams["string"];?>.</p>
                            </div>
                            <div class="mt-4">


                                <button type="button"
                                    class="bottone bottoneL btn btn-outline-danger position-relative me-2 ms-2 mb-2 "><em
                                        class="bi bi-hand-thumbs-up"></em>
                                    <span
                                        class="numeroLike position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $templateParams["numLikes"];?>
                                    </span>
                                </button>

                                <button type="button"
                                    class="btnFire btnFireL btn btn-outline-danger position-relative me-2 ms-2 mb-2 "><em
                                        class="bi bi-fire"></em>
                                    <span
                                        class="numeroFire position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $templateParams["num_fire"];?>
                                    </span>
                                </button>

                                <button type="button"
                                    class="btnSmile btnSmileL btn btn-outline-danger position-relative me-2 ms-2 mb-2 "><em
                                        class="bi bi-emoji-smile-upside-down"></em>
                                    <span
                                        class="numeroSmile position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $templateParams["num_smile"];?>
                                    </span>
                                </button>

                                <button type="button"
                                    class="btnCuore btnCuoreL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em
                                        class="bi bi-heart-fill"></em>
                                    <span
                                        class="numeroCuore position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $templateParams["num_cuore"];?>
                                    </span>
                                </button>

                                <button type="button"
                                    class="btnBacio btnBacioL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em
                                        class="bi bi-emoji-kiss"></em>
                                    <span
                                        class="numeroBacio position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $templateParams["num_baci"];?>
                                    </span>
                                </button>


                            </div>
                        </div>
                        <hr />
                        <div class="input-group mb-4">
                            <label for="commento" class="visually-hidden">Commenta</label>
                            <input type="text" class="commento form-control mx-1" id="commento" placeholder="Commenta">
                            <div class="input-group-append">
                                <button type="submit" id="bttnpost" class="bttnpost btn btn-primary mx-2"
                                    disabled>Commenta</button>
                            </div>
                        </div>
                        <?php foreach ($templateParams["comments"] as $commento): ?>
                        <hr />
                        <div class="d-flex justify-content-between p-2 px-3">
                            <div class="d-flex flex-row align-items-center"> <img
                                    src="<?php echo "../img/".$commento["user_image"];?>" width="30"
                                    class="rounded-circle" alt="">
                                <div class="d-flex flex-column ml-2"> <a class="nav-link"
                                        href="profile.php?username=<?php echo $commento["author"];?>">@<?php echo $commento["author"];?></a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mt-1 ellipsis"> <small
                                    class="mr-2"><?php echo date("F j, Y", strtotime($commento["data_commento"]));?></small>
                                <em class="fa fa-ellipsis-h"></em>
                            </div>
                        </div>



                        <div class="px-4 mt-3 mb-3">
                            
                            <p class="text-justify"><?php echo $commento["post_comment"];?>.</p>
                            <?php if ($commento["author"] == $_SESSION["user_id"]){ ?>
                            <div class="d-flex justify-content-end p-2 px-3">
                                <div class="d-flex flex-row align-items-center">
                                    <button type="button" class="btn btn-danger elimina" id="<?php echo $commento["comment_id"] ; ?>"><em class="bi bi-trash"></em></button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php endforeach; ?>
                        <?php } else { ?>
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-2 px-3">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="d-flex flex-column ml-2">
                                        <h1>Post non trovato</h1>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>