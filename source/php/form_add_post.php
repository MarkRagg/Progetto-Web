<section>
        <form action="insertpost.php" method="POST" enctype="multipart/form-data">
            <h2>Insert post</h2>
            <label for="post">Post</label>
            <input type="text" name="post" id="post">
            <input type="submit" name="submit" value="Posta">
            <a href="../php/showhomepage.php">Back</a>
        </form>
        <p> <?php echo $error; ?> </p>
</section>

