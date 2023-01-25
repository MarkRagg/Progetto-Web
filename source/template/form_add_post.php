<section>
    <div class="d-flex justify-content-center ">
    <div class="flex-column border">
        <div class="p-5">
        <p class="text-danger"> <?php echo $error; ?> </p>
        <form action="insertpost.php" method="POST" enctype="multipart/form-data">
        <label for="post">Il Tuo Nuovo Post</label>
            <hr />
            <textarea class="form-control" id="post" name="post" rows="4"></textarea>
            <small id="passwordHelpBlock" class="form-text text-muted">
                Il post puo' essere lungo massimo 200 caratteri.</small>
            <hr />
            <input class="align-self-end" type="submit" name="submit" value="Posta">
        </form>
        </div>
    </div>
    </div>
</section>

