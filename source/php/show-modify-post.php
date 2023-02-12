<div class="container mt-2 mb-5">
    <div class="justify-content-center border bg-light">
        <div class="p-5">
            <form action="modify-post.php?post_id=<?php echo($templateParams["post_info"]["post_id"]) ?>" method="POST" enctype="multipart/form-data">
                <p class="fs-3 text-center"><strong><label for="post">Modifica il tuo post:</label></strong></p>
                <hr id="formContentDivider" />
                <div id="formContent">
                    <div class="form-check">
                        <input class="form-check-input" value="sameImage" type="radio" name="image" id="sameImage" checked>
                        <label class="form-check-label" for="sameImage">
                            Lascia immagine invariata.
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="deleteImage" type="radio" name="image" id="deleteImage">
                        <label class="form-check-label" for="deleteImage">
                            Elimina immagine.
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" value="changeImage" type="radio" name="image" id="changeImage">
                        <label class="form-check-label" for="changeImage">
                            Cambia o aggiungi immagine.
                        </label>
                    </div>
                    <textarea class="form-control" id="post" name="post" rows="4"><?php echo($templateParams["post_info"]["string"]) ?></textarea>
                </div>
                <hr />
                <div class="d-flex justify-content-between">
                    <input name="delete" type="checkbox" class="btn-check" id="deletePost" autocomplete="off">
                    <label class="btn btn-danger" for="deletePost">Elimina post</label>
                    <button type="submit" data-toggle="button" class="btn btn-outline-primary"
                        name="submit">Conferma</button>
                </div>
            </form>
        </div>
    </div>
</div>