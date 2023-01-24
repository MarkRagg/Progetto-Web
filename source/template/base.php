<!--
    questo file si comporta come il template finale utilizzato per tutte le pagine
    deve includere $templateParams["name"] con require se presente (sarebbe il contenuto del main)
    utilizza i dati in $templateParams pre conpilare l'html
-->

<!DOCTYPE html>
<html lang="it">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body class="">
        <header>
        </header>
        <main>
            <?php
            if (isset($templateParams["name"])) {
                require($templateParams["name"]);
            }
            ?>
        </main>
        <footer>
            <nav class="fixed-bottom">
                <ul class="nav nav-pills justify-content-center nav-fill">
                    <li class="nav-item h4"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item h4"><a class="nav-link active" aria-current="page" href="#">Profilo</a></li>
                    <li class="nav-item h4"><a class="nav-link" href="#">Notifiche</a></li>
                </ul>
            </nav>
        </footer>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <?php 
    if (isset($templateParams["js"])) :
        foreach($templateParams["js"] as $script):
    ?>
    <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</html>