<section>
    <div class="d-flex justify-content-center">
    <div class="flex-column border bg-light">
        <div class="p-5 text-center">
            <p class="text-danger"> <?php echo $error; ?> </p>
            <form action="insertpost.php" method="POST" enctype="multipart/form-data">
            <h2><strong><label for="post">Il Tuo Nuovo Post:</label></strong></h2>
                <hr/>
                <label for="imgarticolo">Aggiungi immagine</label><input type="file" name="imgpost" id="imgpost" />
                <textarea class="form-control" id="post" name="post" rows="4"></textarea>
                <small id="infoPostLunghezza" class="form-text text-muted">
                    Il post puo' essere lungo massimo 200 caratteri.</small>
                <hr/>
                <div class="d-flex justify-content-end">
                    <button type="submit" data-toggle="button" class="btn btn-outline-primary" name="submit">Posta</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</section>

