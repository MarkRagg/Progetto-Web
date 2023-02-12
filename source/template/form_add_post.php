<div class="container mt-2 mb-5">
    <div class="justify-content-center border bg-light">
        <div class="p-5 text-center">
            <p class="text-danger"> <?php echo $error; ?> </p>
            <form action="insertpost.php" method="POST" enctype="multipart/form-data">
                <p class="fs-3"><strong><label for="post">Il Tuo Nuovo Post:</label></strong></p>
                <hr />
                <label for="imgpost">Aggiungi immagine</label><input type="file" name="imgpost" id="imgpost" class="form-control"/>
                <label for="esame">Esame</label>
                <select name="esame" id="esame">
                    <option value="-1" selected>Seleziona una categoria</option>
                    <?php   require_once("db_config.php");
                            $esami = $dbh->getExams();
                            foreach ($esami as $esame) { ?>
                    <option value="<?php echo $esame['esame_id']; ?>"><?php echo $esame['nome']; ?></option>
                    <?php } ?>
                </select>
                <textarea class="form-control" id="post" name="post" rows="4"></textarea>
                <small id="infoPostLunghezza" class="form-text text-muted">
                    Il post puo' essere lungo massimo 200 caratteri.</small>
                <hr />
                <div class="d-flex justify-content-end">
                    <button type="submit" data-toggle="button" class="btn btn-outline-primary"
                        name="submit">Posta</button>
                </div>
            </form>
        </div>
    </div>
</div>