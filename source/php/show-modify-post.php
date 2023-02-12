<div class="container mt-2 mb-5">
    <div class="justify-content-center border bg-light">
        <div class="p-5">
            <form action="insertpost.php" method="POST" enctype="multipart/form-data">
                <p class="fs-3 text-center"><strong><label for="post">Modifica il tuo post:</label></strong></p>
                <hr />
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="image" id="sameImage" checked>
                    <label class="form-check-label" for="sameImage">
                        Lascia immagine invariata.
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="image" id="deleteImage">
                    <label class="form-check-label" for="deleteImage">
                        Elimina immagine.
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="image" id="changeImage">
                    <label class="form-check-label" for="changeImage">
                        Cambia o aggiungi immagine.
                    </label>
                </div>
                <textarea class="form-control" id="post" name="post" rows="4"></textarea>
                <hr />
                <div class="d-flex justify-content-end">
                    <button type="submit" data-toggle="button" class="btn btn-outline-primary"
                        name="submit">Posta</button>
                </div>
            </form>
        </div>
    </div>
</div>